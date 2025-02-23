@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-3/4">
        <h2 class="text-2xl font-bold mb-6 text-center">Employee Dashboard</h2>
        <p class="text-gray-700 text-center">Welcome, <span class="font-semibold">{{ Auth::user()->name }}</span>! Here, you can track your assigned tasks and updates.</p>
        
        <form action="{{ route('logout') }}" method="POST" class="mt-4 text-center">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </div>
</div>
@endsection
