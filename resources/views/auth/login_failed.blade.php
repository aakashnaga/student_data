<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Login Failed</h4>
            <p>{{ $error }}</p>
            <hr>
            <a href="{{ route('login') }}" class="btn btn-primary">Try Again</a>
        </div>
    </div>
</body>
</html>
