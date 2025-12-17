<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'filters' => Filter::count(),
            'users' => User::count(),
        ];

        $latestUsers = User::latest()->take(5)->get();
        $latestProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestProducts'));
    }
}
