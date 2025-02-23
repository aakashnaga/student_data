<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $managerCount = User::where('role', 'manager')->count();
        $employeeCount = User::where('role', 'employee')->count();

        return view('admin.dashboard', compact('userCount', 'managerCount', 'employeeCount'));
    }

    public function listusers()
    {
        $users = User::paginate(10);
        return view('admin.users.list', compact('users'));
    }

    public function listroleusers()
    {
        $users = User::paginate(10);
        return view('admin.users.rolelist', compact('users'));
    }
}
