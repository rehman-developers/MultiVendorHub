<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Student</title>
</head>
<body>
    <div class="container items-center mx-auto">
    <h1 class="text-2xl">Single Student List</h1>
     <table class="table-auto">
  <thead>
    <tr>
      <th class="border">Name</th>
      <th class="border">Email</th>
      <th class="border">Age</th>
      <th class="border">City</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($data as $id => $student )
    <tr>
      <td  class="p-2 border">{{ $student->name }}</td>
      <td  class="p-2 border">{{ $student->age }}</td>
      <td  class="p-2 border">{{ $student->email }}</td>
      <td  class="p-2 border">{{ $student->city }}</td>
     </tr>
    @endforeach
</tbody>
 
</table>
</div>
</body>
</html>


