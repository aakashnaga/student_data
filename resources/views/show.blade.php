<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            margin: 8px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            text-decoration: none;
            color: white;
            background: #007bff;
            border-radius: 5px;
            border: none;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Details</h2>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Age:</strong> {{ $user->age }}</p>
    <p><strong>Address:</strong> {{ $user->address }}</p>
    <p><strong>Image:</strong>  <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="100"></p>
    <p><strong>Document:</strong>  <a href="{{ asset('storage/' . $user->document) }}" target="_blank">View</a></p>
    <h3>Subject Marks</h3>
    @if($user->subjects)
            <div id="subjects">
                @foreach ($user->subjects as $index => $subject)
                <div class="subject-group">
                    <input type="text" name="subjects[name]" value="{{ $subject['name'] }}" required>
                    <input type="number" name="subjects[marks]" value="{{ $subject['marks'] }}" required>
                </div>
                @endforeach
            </div>
            @endif
    <a href="{{ url('/users') }}" class="btn">Back to List</a>
</div>

</body>
</html>
