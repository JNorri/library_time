<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
</head>

<body>
    <h1>Departments</h1>
    <ul>
        @foreach($departments as $department)
        <li>
            <strong>ID:</strong> {{ $department->department_id }}<br>
            <strong>Name:</strong> {{ $department->department_name }}<br>
            <strong>Description:</strong> {{ $department->department_description }}<br>
            <strong>Parent ID:</strong> {{ $department->parent_id }}<br>
        </li>
        @endforeach
    </ul>
</body>

</html> -->