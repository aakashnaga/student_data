<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h2>Enter OTP</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('auth.verify_otp.post') }}">
        @csrf
        <label>Enter OTP:</label>
        <input type="text" name="otp" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
