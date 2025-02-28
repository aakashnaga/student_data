@extends('layout')

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 600px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    input, button {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #28a745;
        color: white;
        border: none;
        cursor: pointer;
        margin-top: 15px;
    }

    button:hover {
        background-color: #218838;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }

    .success {
        color: green;
        margin-bottom: 10px;
    }

    img {
        display: block;
        margin-top: 5px;
        width: 100px;
        height: auto;
    }

    .subject-group {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .back-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #007bff;
    }

    .back-btn:hover {
        background-color: #0056b3;
    }
</style>
<script>
function addSubjectField() {
    let subjectDiv = document.getElementById('subjects');
    let index = subjectDiv.children.length;
    let html = `
        <div class="subject-group">
            <input type="text" name="subjects[\${index}][name]" placeholder="Subject Name" required>
            <input type="number" name="subjects[\${index}][marks]" placeholder="Marks" required>
        </div>
    `;
    subjectDiv.insertAdjacentHTML('beforeend', html);
}
</script>
<div class="container">
    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ url('/users/'.$user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <label>Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label>Age:</label>
        <input type="number" name="age" value="{{ $user->age }}" required>

        <label>Address:</label>
        <input type="text" name="address" value="{{ $user->address }}" required>

       
        <label>Profile Image:</label>
        @if($user->image)
        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="100">
        @endif
        <input type="file" name="image">

       
        <label>Document:</label>
        @if($user->document)
            <a href="{{ asset('storage/'.$user->document) }}" target="_blank">View Document</a>
        @endif
        <input type="file" name="document">

       
        <h3>Subject Marks</h3>
        <div id="subjects">
        @if($user->subjects)
            @foreach ($user->subjects as $index => $subject)
                <div class="subject-group">
                    <input type="text" name="subjects[{{ $index }}][name]" value="{{ $subject['name'] }}" required>
                    <input type="number" name="subjects[{{ $index }}][marks]" value="{{ $subject['marks'] }}" required>
                </div>
            @endforeach
        </div>
        @endif
        <button type="button" onclick="addSubjectField()">Add Subject Marks</button>
 
        <button type="submit">Update</button>
    </form>

    <a href="{{ url('/users') }}" class="back-btn">
        <button class="back-btn">Back to Users List</button>
    </a>
</div>



