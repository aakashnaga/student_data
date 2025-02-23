<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Middleware to restrict access
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show Users List
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Show Create User Form
    public function create()
    {
        return view('admin.users.create');
    }

    // Store New User
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,manager,employee',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show Edit User Form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required|in:admin,manager,employee',
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete User
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function softDelete(User $user)
    {
        $user->update(['deleted_at' => 1]);
        return back()->with('success', 'User moved to trash.');
    }

    // Restore user (set deleted_at = 0)
    public function restore(User $user)
    {
        $user->update(['deleted_at' => 0]);
        return back()->with('success', 'User restored successfully.');
    }

    // Permanently delete user
    public function permanentDelete(User $user)
    {
        try {
            $user->delete();
            return back()->with('success', 'User permanently deleted.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete user permanently.');
        }
    }
}
