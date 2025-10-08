@extends('layout')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-4">Register</h2>

  <form action="{{ route('registerSave') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium mb-1">Name</label>
      <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Email</label>
      <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
    </div>
<div>
        <label class="block text-sm font-medium mb-1">Age</label>
        <input type="number" name="age" value=""class="w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Role</label>
        <select name="role">
            <option value="guest">Guest</option>
            <option value="admin">Admin</option>
        </select>
     </div>
    <div>
      <label class="block text-sm font-medium mb-1">Password</label>
      <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Confirm Password</label>
      <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded">Create Account</button>
    </div>
</form>
        <a href="{{ route('home') }}">
            <button class="w-full bg-gray-600 text-white px-4 py-2 rounded my-3">Back</button>
        </a>

  <p class="mt-4 text-sm text-gray-600">Already have account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
</div>
@endsection
