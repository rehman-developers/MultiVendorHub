@extends('layout')

@section('title')
<h1 class="font-bold">Single Student Data</h1>  
@endsection

@section('content')
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
     <table class="table-auto">
  <thead>
    <tr>
      <th class="border">ID</th>
      <th class="border">Name</th>
      <th class="border">Email</th>
      <th class="border">Age</th>
      <th class="border">City</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($students as $data)
    
    <tr>
      <td  class="p-2 border">{{$data->id}}</td>
      <td  class="p-2 border">{{$data->name}}</td>
      <td  class="p-2 border">{{$data->email}}</td>
      <td  class="p-2 border">{{$data->age}}</td>
      <td  class="p-2 border">{{$data->city}}</td>
    </tr>
    @endforeach
  </tbody>
  
</table>
</div>
<a href="{{ route('student.index') }}"class= "btn text-white mx-5  bg-red-800 rounded p-1">Back</a>
@endsection