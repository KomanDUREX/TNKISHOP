<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'accounts' => Category::firstOrCreate(['slug' => 'accounts'], ['name' => 'Акаунти']),
            'gold' => Category::firstOrCreate(['slug' => 'gold'], ['name' => 'Золото']),
            'silver' => Category::firstOrCreate(['slug' => 'silver'], ['name' => 'Срібло']),
            'bundles' => Category::firstOrCreate(['slug' => 'bundles'], ['name' => 'Комбо']),
        ];

        $products = [
            [
                'category_id' => $categories['accounts']->id,
                'title' => 'WoT Blitz акаунт 10 рівнів',
                'description' => 'Топова техніка X рівня, WR 55%, екіпаж 100%, укомплектовані слоти.',
                'type' => 'account',
                'game' => 'blitz',
                'badge' => 'Топ техніка',
                'price' => 2100,
                'includes' => ['5 танків X рівня', '6000 золота', '2 000 000 срібла', 'Преміум 30 днів'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['gold']->id,
                'title' => 'WoT Blitz золото 12000',
                'description' => 'Безпечна передача через магазин, миттєва доставка.',
                'type' => 'gold',
                'game' => 'blitz',
                'badge' => 'Топ продаж',
                'price' => 1399,
                'includes' => ['12 000 золота', 'Підтримка 24/7'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['silver']->id,
                'title' => 'WoT Blitz срібло 5 млн',
                'description' => 'Пакет срібла для швидкої прокачки та екіпіровки.',
                'type' => 'silver',
                'game' => 'blitz',
                'badge' => 'Швидка доставка',
                'price' => 850,
                'includes' => ['5 000 000 срібла', 'Бонус 5% срібла'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['accounts']->id,
                'title' => 'WoT акаунт VIII-X рівні',
                'description' => 'WR 58%, акційні премиуми, екіпажі прокачані.',
                'type' => 'account',
                'game' => 'wot',
                'badge' => 'Готовий до бою',
                'price' => 3200,
                'includes' => ['7 танків X', '21 преміум', '4500 золота', '4 500 000 срібла'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['gold']->id,
                'title' => 'WoT золото 10000',
                'description' => 'Поповнення золота для WoT, доставка за 15 хв.',
                'type' => 'gold',
                'game' => 'wot',
                'badge' => 'Гаряча ціна',
                'price' => 1290,
                'includes' => ['10 000 золота', 'Бонус 500 золота'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['silver']->id,
                'title' => 'WoT срібло 8 млн',
                'description' => 'Срібло для дослідження гілок і переобладнання.',
                'type' => 'silver',
                'game' => 'wot',
                'badge' => 'Багато срібла',
                'price' => 990,
                'includes' => ['8 000 000 срібла', 'Бонус 5%'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['accounts']->id,
                'title' => 'WoT Blitz акаунт з преміумами',
                'description' => 'Рідкі преміумні танки, WR 62%, готовий до КБ.',
                'type' => 'account',
                'game' => 'blitz',
                'badge' => 'Рідкі танки',
                'price' => 3800,
                'includes' => ['5 рідкі преміуми', '62% WR', '8 000 золота'],
                'is_active' => true,
            ],
            [
                'category_id' => $categories['bundles']->id,
                'title' => 'WoT комплект золото + срібло',
                'description' => 'Золото та срібло в одному наборі для швидкого бусту.',
                'type' => 'bundle',
                'game' => 'wot',
                'badge' => 'Набір',
                'price' => 1790,
                'includes' => ['6 000 золота', '6 000 000 срібла'],
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['title' => $product['title']],
                $product
            );
        }
    }
}
