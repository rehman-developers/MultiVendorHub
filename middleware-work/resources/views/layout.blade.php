<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'My Site')</title>
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
        <a href="{{ route('login') }}" class="hover:underline">Login</a>
        <a href="{{ route('register') }}" class="hover:underline">Register</a>
      </nav>
    </div>
  </header>

  <main class="flex-1 container mx-auto w-full p-6">
    @yield('content')
  </main>

  <footer class="bg-gray-900 text-white text-center p-4">
    © {{ date('Y') }} My Laravel WebApp
  </footer>
</body>
</html>
