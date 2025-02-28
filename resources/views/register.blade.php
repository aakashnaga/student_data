<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
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

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 40%;
            margin: 20px auto;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .subject-group {
            display: flex;
            gap: 10px;
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
    <script>
        function addSubjectField() {
            let subjectDiv = document.getElementById('subjects');
            let index = subjectDiv.children.length;
            let html = `
                <div class="subject-group">
                    <input type="text" name="subjects[${index}][name]" placeholder="Subject Name" required>
                    <input type="number" name="subjects[${index}][marks]" placeholder="Marks" min="0" max="100" required>
                </div>
            `;
            subjectDiv.insertAdjacentHTML('beforeend', html);
        }
    </script>
</head>

<body>
    <h2>User Registration</h2>
    <a href="{{ url('/users') }}" style="position: absolute; top: 10px; right: 500px;">
    <button type="button">Back to Users List</button>
</a>


    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ url('/users') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="number" name="age" placeholder="Age" required><br>
        <input type="address" name="address" placeholder="Address" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label>Upload Profile Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <label>Upload Document (PDF, DOCX, TXT):</label>
        <input type="file" name="document" accept=".pdf,.doc,.docx,.txt" required><br>

        <h3>Subject Marks</h3>
        <div id="subjects"></div>
        <button type="button" onclick="addSubjectField()">Add Subject Marks</button><br>

        <button type="submit">Submit</button>
    </form>

    <!-- <a href="{{ url('/users') }}">
        <button>Back to Users List</button>
    </a> -->

</body>

</html>

