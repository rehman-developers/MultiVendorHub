<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">
  <header class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="{{ route('home') }}" class="text-lg font-bold">My Laravel WebApp</a>
      <div class="text-center text-xl font-bold">
        <h1>Laravel Authentication</h1>
      </div>
      <nav class="space-x-4">
        <a href="{{route('inner') }}" class="hover:underline">Inner</a>
        <a href="{{route('logout') }}" class="hover:underline">Logout</a>
      </nav>
    </div>
  </header>

  <main class="flex-1 container mx-auto w-full p-6">
  <div class="max-w-3xl mx-auto text-center">
  <h1 class="text-3xl font-bold mb-6">Welcome to My WebApp {{ Auth::user()->name}}</h1>
 
  <div class="flex justify-center gap-4">
    <a href="{{route('inner') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
      Inner
    </a>

    <a href="{{ route('logout') }}" class="px-6 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-blue-50 transition">
      Logout
    </a>
  </div>
  <a href="{{ route('home') }}">
           <button class="w-full bg-gray-600 text-white px-4 py-2 rounded my-3">Back</button>
       </a>
</div>
  </main>

  <footer class="bg-gray-900 text-white text-center p-4">
    © {{ date('Y') }} My Laravel WebApp
  </footer>
</body>
</html>
