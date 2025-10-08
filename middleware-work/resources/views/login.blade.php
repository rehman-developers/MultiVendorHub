@extends('layout')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-4">Login</h2>

  <form action="{{ route('loginMatch') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium mb-1">Email</label>
      <input type="email" name="email" class="w-full border rounded px-3 py-2" placeholder="you@example.com" required>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Password</label>
      <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded">Sign In</button>
    </div>
</form>
       <a href="{{ route('home') }}">
             <button class="w-full bg-gray-600 text-white px-4 py-2 my-3 rounded">Back</button>
       </a>

  <p class="mt-4 text-sm text-gray-600">No account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a></p>
</div>
@endsection
