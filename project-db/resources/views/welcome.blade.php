<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Students</title>
</head>
<body>
    <div class="container items-center mx-auto">
    <h1 class="text-2xl">All Student List</h1>
     <table class="table-auto">
       <div class="p-2 "><a href="/new"class= "btn text-white  bg-green-800 rounded p-1 gap-2">Add Student</a></div>

  <thead>
    <tr>
      <th class="border">ID</th>
      <th class="border">Name</th>
      <th class="border">Email</th>
      <th class="border">Age</th>
      <th class="border">City</th>
      <th class="border">View</th>
      <th class="border">Delete</th>
      <th class="border">Update</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($data as $id => $student )
    <tr>
        <td  class="p-2 border">    {{ $student->id }}</td>
      <td  class="p-2 border">    {{ $student->name }}</td>
      <td  class="p-2 border"> {{ $student->age }}</td>
      <td  class="p-2 border">    {{ $student->email }}</td>
      <td  class="p-2 border">    {{ $student->city }}</td>
      <td class="p-2 border"><a href="{{ route('student', $student->id)}}"class= "btn text-white  bg-blue-900 rounded p-1 gap-2">View</a></td>
      <td class="p-2 border"><a href="{{ route('delete', $student->id)}}"class= "btn text-white  bg-red-800 rounded p-1 gap-2">Delete</a></td>
      <td class="p-2 border"><a href="{{ route('update', $student->id)}}"class= "btn text-white  bg-yellow-800 rounded p-1 gap-2">Update</a></td>
    </tr>
    @endforeach
</tbody>
 
</table>
<div class="text-white bg-blue-900 ">
  {{$data->links()}}
</div>
</div>
</body>
</html>


