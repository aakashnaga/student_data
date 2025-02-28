<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'age' => 'required|integer',
                'address' => 'required|string',
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                'document' => 'required|mimes:pdf,doc,docx,txt|max:2048',
            ]);

            $imagePath = $request->file('image')->store('uploads/images', 'public');
            $documentPath = $request->file('document')->store('uploads/documents', 'public');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'age' => $request->age,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'subjects' => $request->subjects ?? [],
                'image' => $imagePath,
                'document' => $documentPath,
            ]);
            return redirect('/users')->with('success', 'User Registered Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong: ');
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect('/users')->with('error', 'User not found');
        }
        return view('show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect('/users')->with('error', 'User not found');
        }
        return view('edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'age' => 'required|integer',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx,txt|max:2048',
            'subjects' => 'nullable|array',
            'subjects.*.name' => 'required|string',
            'subjects.*.marks' => 'required|integer|min:0|max:100',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->address = $request->address;

        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('uploads/images', 'public');
            
        }

        if ($request->hasFile('document')) {
            $user->document = $request->file('document')->store('uploads/documents', 'public');
        }
        
        $user->subjects = $request->subjects;
        $user->save();

        return redirect('/users')->with('success', 'User updated successfully!');
    }



    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect('/users')->with('error', 'User not found');
        }

        $user->delete();
        return redirect('/users')->with('success', 'User deleted successfully');
    }
}
