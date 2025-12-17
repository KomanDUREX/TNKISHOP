<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        $products = $this->safeProductsQuery()
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', [
            'products' => $products,
            'title' => 'Tankist Store - WoT & WoT Blitz',
            'meta' => 'Магазин акаунтів, золота та срібла для World of Tanks і WoT Blitz.',
        ]);
    }

    public function products()
    {
        $products = $this->safeProductsQuery()
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products', [
            'products' => $products,
            'title' => 'Усі товари - Tankist Store',
            'meta' => 'Каталог акаунтів, золота та срібла World of Tanks і Blitz.',
        ]);
    }

    public function catalog(Request $request)
    {
        $filters = $request->only(['type', 'game', 'price']);

        $query = $this->safeProductsQuery()->where('is_active', true);

        $typeFilters = $this->safeFiltersQuery('type')->unique('slug')->values();
        $gameFilters = $this->safeFiltersQuery('game')->unique('slug')->values();

        if ($typeFilters->isEmpty()) {
            $distinctTypes = $this->safeProductsQuery()->whereNotNull('type')->select('type')->distinct()->get();
            $typeFilters = $distinctTypes->map(function ($row) {
                $slug = Str::lower((string) $row->type);
                return (object) ['slug' => $slug, 'name' => ucfirst($slug)];
            })->unique('slug')->values();
        }

        if ($gameFilters->isEmpty()) {
            $distinctGames = $this->safeProductsQuery()->whereNotNull('game')->select('game')->distinct()->get();
            $gameFilters = $distinctGames->map(function ($row) {
                $slug = Str::lower((string) $row->game);
                $name = $slug === 'blitz' || $slug === 'wot blitz' ? 'WoT Blitz' : ($slug === 'wot' ? 'World of Tanks' : ucfirst($slug));
                return (object) ['slug' => $slug, 'name' => $name];
            })->unique('slug')->values();
        }

        $types = $typeFilters->pluck('slug')->all();
        $games = $gameFilters->pluck('slug')->all();

        if ($filters['type'] ?? false) {
            if (in_array($filters['type'], $types, true)) {
                $query->where('type', $filters['type']);
            } else {
                $filters['type'] = null;
            }
        }
        if ($filters['game'] ?? false) {
            if (in_array($filters['game'], $games, true)) {
                $query->where('game', $filters['game']);
            } else {
                $filters['game'] = null;
            }
        }
        if ($filters['price'] ?? false) {
            $filters['price'] = is_numeric($filters['price']) ? (float) $filters['price'] : null;
            if ($filters['price']) {
                $query->where('price', '<=', $filters['price']);
            }
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('catalog', [
            'products' => $products,
            'filters' => $filters,
            'typeFilters' => $typeFilters,
            'gameFilters' => $gameFilters,
            'title' => 'Каталог - Tankist Store',
            'meta' => 'Фільтр акаунтів і валют WoT / Blitz за типом, грою та ціною.',
        ]);
    }

    public function favorites()
    {
        $favorites = $this->mapSessionItems(session('favorites', []));

        return view('favorites', [
            'products' => $favorites,
            'title' => 'Улюблені - Tankist Store',
            'meta' => 'Обране: акаунти, золото та срібло для WoT і Blitz.',
        ]);
    }

    public function cart()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = $this->findProduct((int) $id);
            if ($product) {
                $product->qty = $qty;
                $product->line_total = $product->price * $qty;
                $items[] = $product;
                $total += $product->line_total;
            }
        }

        return view('cart', [
            'products' => $items,
            'total' => $total,
            'title' => 'Кошик - Tankist Store',
            'meta' => 'Кошик товарів Tankist Store.',
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'Про Tankist Store',
            'meta' => 'Про нас Tankist Store WoT і Blitz.',
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'title' => 'Контакти Tankist Store',
            'meta' => 'Email, Telegram, Discord для зв’язку.',
        ]);
    }

    public function addToCart(Request $request, int $id)
    {
        $cart = session('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        session(['cart' => $cart]);

        return back()->with('status', 'Товар додано до кошика');
    }

    public function removeFromCart(int $id)
    {
        $cart = session('cart', []);
        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return back()->with('status', 'Товар видалено з кошика');
    }

    public function updateCartQuantity(Request $request, int $id)
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = session('cart', []);
        if (array_key_exists($id, $cart)) {
            $cart[$id] = $data['qty'];
            session(['cart' => $cart]);
        }

        return back()->with('status', 'Кількість оновлено');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        $selected = array_filter($request->input('selected', []), fn ($id) => array_key_exists($id, $cart));

        if (empty($selected) && empty($cart)) {
            return back()->with('status', 'Кошик порожній');
        }

        $idsToPurchase = !empty($selected) ? $selected : array_keys($cart);
        $items = [];
        $total = 0;

        foreach ($idsToPurchase as $id) {
            $product = $this->findProduct((int) $id);
            if ($product) {
                $qty = $cart[$id] ?? 1;
                $product->qty = $qty;
                $product->line_total = $product->price * $qty;
                $items[] = $product;
                $total += $product->line_total;
                unset($cart[$id]);
            }
        }

        session(['cart' => $cart]);

        return back()->with('status', 'Замовлення оформлено! Очікуйте на пошту.');
    }

    public function addToFavorites(int $id)
    {
        $favorites = session('favorites', []);
        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
            session(['favorites' => $favorites]);
        }

        return back()->with('status', 'Додано в улюблені');
    }

    public function removeFromFavorites(int $id)
    {
        $favorites = session('favorites', []);
        $filtered = array_values(array_filter($favorites, fn ($favId) => (int) $favId !== $id));
        session(['favorites' => $filtered]);

        return back()->with('status', 'Видалено з улюблених');
    }

    public function clearFavorites()
    {
        session()->forget('favorites');

        return back()->with('status', 'Список улюблених очищено');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:500'],
        ]);

        return back()->with('status', 'Повідомлення відправлено, ми скоро відповімо')->with('submitted', $data);
    }

    private function findProduct(int $id): ?Product
    {
        return $this->safeProductsQuery()->where('is_active', true)->find($id);
    }

    private function mapSessionItems(array $ids)
    {
        return $this->safeProductsQuery()->whereIn('id', $ids)->where('is_active', true)->get();
    }

    private function safeProductsQuery()
    {
        if (!Schema::hasTable('products')) {
            return Product::query()->whereRaw('1=0');
        }

        return Product::query()->select(['id', 'category_id', 'title', 'description', 'type', 'game', 'badge', 'price', 'includes', 'is_active', 'created_at']);
    }

    private function safeFiltersQuery(string $group)
    {
        if (!Schema::hasTable('filters')) {
            return collect();
        }

        return Filter::where('group', $group)->where('is_active', true)->orderBy('sort_order')->get();
    }
}
