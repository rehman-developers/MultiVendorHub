@extends('layout')

@section('title', 'Home')

@section('content')
<div class="max-w-3xl mx-auto text-center">
  <h1 class="text-3xl font-bold mb-6">Welcome to My WebApp</h1>
  <p class="mb-8 text-gray-700">Hello Guest.</p>

  <div class="flex justify-center gap-4">
    <a href="{{route('home') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
      Back
    </a>

    <a href="{{ route('logout') }}" class="px-6 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-blue-50 transition">
      Logout
    </a>
  </div>
</div>
@endsection
