@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('auth.forgot') }}" class="text-blue-500">Forgot Password?</a>
        </div>

        <div class="mt-2 text-center">
            <p class="text-gray-600">Don't have an account? 
                <a href="{{ route('auth.register') }}" class="text-blue-500 hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>
@endsection
