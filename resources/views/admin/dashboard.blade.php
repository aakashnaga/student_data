@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center p-6 relative">
    
    <!-- Logout Button (Top Right Corner) -->
    <form action="{{ route('logout') }}" method="POST" class="absolute top-4 right-6">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600">
            Logout
        </button>
    </form>

    <!-- Welcome Admin -->
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome, {{ auth()->user()->name }}</h2>

    <div class="bg-white w-full max-w-5xl p-6 shadow-lg rounded-lg">
        
        <!-- User Counts Grid -->
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-blue-500 text-white p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold">Total Users</h3>
                <p class="text-3xl font-bold">{{ $userCount ?? "" }}</p>
            </div>
            <div class="bg-green-500 text-white p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold">Managers</h3>
                <p class="text-3xl font-bold">{{ $managerCount ?? "" }}</p>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold">Employees</h3>
                <p class="text-3xl font-bold">{{ $employeeCount ?? "" }}</p>
            </div>
        </div>

        <!-- Manage Users Button (Centered Below Counts) -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('admin.users.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600">
                Manage Users
            </a>
        </div>
        
    </div>
</div>
@endsection
