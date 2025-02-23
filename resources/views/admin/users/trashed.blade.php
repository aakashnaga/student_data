@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Trashed Users</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary mb-3">Back to Users</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('admin.users.restore', $user->_id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-undo"></i> Restore
                        </button>
                    </form>

                    <form action="{{ route('admin.users.forceDelete', $user->_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete permanently?');">
                            <i class="fas fa-trash-alt"></i> Permanent Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
