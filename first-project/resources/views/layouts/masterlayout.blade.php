<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">Welcome to My Website</h1>
            <p class="mt-2">This is a responsive home page with Tailwind CSS.</p>
        </div>
    </header>

    <!-- Main Content with Sidebar and Navbar -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4 hidden md:block">
            <h2 class="text-xl font-semibold mb-4">Sidebar</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="hover:text-blue-300">Home</a></li>
                <li><a href="{{ route('blog') }}" class="hover:text-blue-300">About</a></li>
              </ul>
        </aside>

        <!-- Navbar -->
        <nav class="bg-gray-200 p-4 w-full md:hidden">
            <div class="container mx-auto">
                <button class="text-blue-600 focus:outline-none">Menu</button>
            </nav>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="container mx-auto">
                @yield('content') <!-- Yahan child ka content aayega -->
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 My Website. All rights reserved.</p>
            <div class="mt-2 space-x-4">
                <a href="#" class="hover:text-blue-300">Privacy</a>
                <a href="#" class="hover:text-blue-300">Terms</a>
                <a href="#" class="hover:text-blue-300">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>