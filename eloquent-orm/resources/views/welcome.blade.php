@extends('layout')

@section('title')
<h1 class="font-bold text-center my-5">All Students Data</h1>  
@endsection

@section('content')
  <div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
     <table class="table-auto">
       <div class="p-2 "><a href="{{ route('student.create') }}"class= "btn text-white  bg-green-800 rounded p-1 gap-2">Add Student</a></div>

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
  @foreach ($students as $data)
    
    <tr>
      <td  class="p-2 border">{{$data->id}}</td>
      <td  class="p-2 border">{{$data->name}}</td>
      <td  class="p-2 border">{{$data->email}}</td>
      <td  class="p-2 border">{{$data->age}}</td>
      <td  class="p-2 border">{{$data->city}}</td>
      <td class="p-2 border"><a href="{{ route('student.show',$data->id) }}"class= "btn text-white  bg-blue-900 rounded p-1 gap-2">View</a></td>
      <td class="p-2 border">
        <form action="{{ route('student.destroy',$data->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class= "btn text-white  bg-red-800 rounded p-1 gap-2">Delete</button>
        </form>
      </td>
      <td class="p-2 border"><a href="{{ route('student.edit',$data->id) }}"class= "btn text-white  bg-yellow-800 rounded p-1 gap-2">Update</a></td>
    </tr>
   @endforeach
</tbody>
 
</table>
<div class="text-center text-black">
  {{$students->links()}}
</div>
  </div>
@endsection