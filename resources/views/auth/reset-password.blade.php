@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>

        <form method="POST" action="{{ route('auth.reset') }}">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">OTP</label>
                <input type="text" name="otp" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">New Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Reset Password
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('auth.login') }}" class="text-blue-500">Back to Login</a>
        </div>
    </div>
</div>
@endsection
