@extends('layout')

@section('title', 'Home')

@section('content')
<div class="max-w-3xl mx-auto text-center">
  <h1 class="text-3xl font-bold mb-6">Welcome to My WebApp</h1>
  <p class="mb-8 text-gray-700">Click a button to go to Login or Register page.</p>

  <div class="flex justify-center gap-4">
    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
      Login
    </a>

    <a href="{{ route('register') }}" class="px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
      Register
    </a>
  </div>
</div>
@endsection
