<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->is_admin) {
            return back()->withErrors(['������������ �� ����� ��������']);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('status', $user->is_active ? '����������� ����������' : '����������� ������������');
    }
}
