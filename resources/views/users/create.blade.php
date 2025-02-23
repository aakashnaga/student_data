@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create a New Users</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">User Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter users name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <textarea name="role" id="role" class="form-control" placeholder="Enter user role" required></textarea>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <select class="form-control" id="country" name="country" required>
                <option value="India">India</option>
                <option value="USA">USA</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Save User</button>
        <a href="{{ route('admin.users.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
