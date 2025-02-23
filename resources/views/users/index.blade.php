@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">User List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($users->isEmpty())
        <p class="text-center">No users available. Please check back later!</p>
    @else
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->description ?? 'No description available.' }}</p>
                            <p><strong>Price:</strong> ${{ number_format($user->price, 2) }}</p>
                            <a href="{{ route('users.buy', $user->id) }}" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $users->links() }} <!-- Pagination -->
        </div>
    @endif
</div>
@endsection
