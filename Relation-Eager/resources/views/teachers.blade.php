<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teachers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<h1 class="text-3xl font-bold text-center mb-4">Teacher Details</h1>

@foreach($teachers as $teacher)
    <div class="bg-white shadow-md rounded-lg p-4 mb-4">
        <h2 class="text-xl font-semibold text-blue-600">{{ $teacher->name }}</h2>

        <h3 class="mt-2 font-semibold text-gray-700">Students:</h3>
        <ul class="list-disc ml-5 text-gray-600">
            @foreach($teacher->students as $student)
                <li>{{ $student->name }}</li>
            @endforeach
        </ul>

        <h3 class="mt-2 font-semibold text-gray-700">Subjects:</h3>
        <ul class="list-disc ml-5 text-gray-600">
            @foreach($teacher->subjects as $subject)
                <li>{{ $subject->title }}</li>
            @endforeach
        </ul>
    </div>
@endforeach

</body>
</html>
