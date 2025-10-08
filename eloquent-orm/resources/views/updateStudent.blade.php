@extends('layout')

@section('title')
   <h3 class="text-center"> Update Student Data</h3>
@endsection

@section('content')
    <div class="flex justify-center px-6 py-12 lg:px-8">
       <form action="{{route('student.update',$students->id)}}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
          <div>
        <label for="name" class="block text-sm/6 font-medium ">Name</label>
        <div class="mt-2">
          <input type="text" name="stname" value="{{$students->name}}" required class="block w-full rounded-md border px-3 py-1.5 " />
        </div>
      </div>
      <div>
        <label for="email" class="block text-sm/6 font-medium ">Email</label>
        <div class="mt-2">
          <input type="email" name="stemail" value="{{$students->email}}"  required class="block w-full rounded-md border  px-3 py-1.5   " />
        </div>
      </div>

         <div>
        <label for="age" class="block text-sm/6 font-medium">Age</label>
        <div class="mt-2">
          <input type="number" name="stage" value="{{$students->age}}" required class="block w-full rounded-md border px-3 py-1.5 text-base " />
        </div>
      </div>
        <div>
        <label for="city" class="block text-sm/6 font-medium">City</label>
        <div class="mt-2">
          <input  type="text" name="stcity" value="{{$students->city}}" required class="block w-full rounded-md border px-3 py-1.5 text-base  " />
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-blue-900 px-3 py-1.5 text-sm/6 font-semibold
         text-white hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Update Student</button>
      </div>
    </form>
    </div>
@endsection