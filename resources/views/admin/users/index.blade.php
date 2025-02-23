@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Users</h1>

    <!-- New User Button -->
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Add New User</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="bg-primary text-white">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="{{ $user->deleted_at ? 'opacity-50' : '' }}">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <!-- Edit -->
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        ✏️ Edit
                    </a>

                    @if($user->deleted_at == 0)
                    <!-- Soft Delete (Hide) -->
                    <form action="{{ route('admin.users.softDelete', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
                    </form>
                    @else
                    <!-- Restore -->
                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">🔄 Restore</button>
                    </form>

                    <!-- Permanent Delete -->
                    <form action="{{ route('admin.users.permanentDelete', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark btn-sm">❌ Permanent Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

<!-- Custom CSS to reduce pagination symbol size -->
<style>
    .pagination svg {
        width: 15px !important;
        height: 15px !important;
    }
</style>
@endsection