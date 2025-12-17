<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FilterController extends Controller
{
    public function index()
    {
        $filters = Filter::orderBy('group')->orderBy('sort_order')->paginate(20);
        return view('admin.filters.index', compact('filters'));
    }

    public function create()
    {
        return view('admin.filters.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Filter::create($data);
        return redirect()->route('admin.filters.index')->with('status', 'Фільтр створено');
    }

    public function edit(Filter $filter)
    {
        return view('admin.filters.edit', compact('filter'));
    }

    public function update(Request $request, Filter $filter)
    {
        $data = $this->validated($request, $filter->id);
        $filter->update($data);
        return redirect()->route('admin.filters.index')->with('status', 'Фільтр оновлено');
    }

    public function destroy(Filter $filter)
    {
        $filter->delete();
        return redirect()->route('admin.filters.index')->with('status', 'Фільтр видалено');
    }

    private function validated(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'group' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:120'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $slug = $data['slug'] ?: Str::slug($data['name']);
        $exists = Filter::where('group', $data['group'])->where('slug', $slug);
        if ($id) {
            $exists->where('id', '!=', $id);
        }
        if ($exists->exists()) {
            throw ValidationException::withMessages(['slug' => 'Поєднання group+slug вже існує']);
        }

        $data['slug'] = $slug;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
