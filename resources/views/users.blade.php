@extends('layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #28a745;
            color: white;
        }

        button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>

<body>
    <h2>User List</h2>
    <!-- <a href="{{ url('/register') }}">
    <button>Register New User</button>
</a> -->
    <a href="{{ url('/register') }}" style="position: absolute; top: 10px; right: 500px;">
        <button type="button">Register New User</button>
    </a>

    <table border = "1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Age</th>
            <th>Image</th>
            <th>Document</th>
            <th>Subjects & Marks</th>
            <th>Actions</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->age }}</td>
            @if($user->image)
            <td><img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="100"></td>
            @else
            <td>No image</td>
            @endif

            @if($user->document)
            <td> <a href="{{ asset('storage/' . $user->document) }}" target="_blank">View</a></td>
            @else
            <td>No document</td>
            @endif
            <td>
                @if (!empty($user->subjects))
                <ul>
                    @foreach ($user->subjects as $subject)
                    <li>{{ $subject['name'] }}: {{ $subject['marks'] }} Marks</li>
                    @endforeach
                </ul>
                @else
                No subjects added
                @endif
            </td>

            <td>
                <a href="{{ url('/users/'.$user->id) }}" title="View">
                    <i class="fas fa-eye" style="color: blue;"></i>
                </a>
                |
                <a href="{{ url('/users/'.$user->id.'/edit') }}" title="Edit">
                    <i class="fas fa-edit" style="color: green;"></i>
                </a>
                |
                <form action="{{ url('/users/'.$user->id.'/delete') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure?')" style="border: none; background: none; cursor: pointer;">
                        <i class="fas fa-trash" style="color: red;"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>