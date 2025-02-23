@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase User</h1>
    <p><strong>User:</strong> {{ $user->name }}</p>
    <p><strong>Price:</strong> ${{ number_format($user->price, 2) }}</p>

    <form action="{{ route('payments.process', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Proceed to Payment</button>
    </form>
</div>
@endsection
