<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MultiVendorHub')</title>

     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- IMPERSONATE ALERT -->
    @if(session('impersonating'))
        <div class="bg-red-600 text-white p-4 shadow-lg text-center font-bold">
            <i class="fas fa-user-secret mr-2"></i>
            <strong>IMPERSONATING:</strong> {{ auth()->user()->name }}
            <a href="{{ route('impersonate.stop') }}" class="ml-3 underline hover:text-gray-200">
                Stop Impersonating
            </a>
        </div>
    @endif

    <!-- HEADER -->
    <header class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-wide flex items-center">
                <i class="fas fa-store mr-2"></i> MultiVendorHub
            </a>

            <div class="flex items-center space-x-6 text-sm">
                @auth
                    <!-- Role-Based Dashboard -->
                    @if(auth()->user()->role == 0)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2">Admin Dashboard</a>
                    <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2">Seller Dashboard (as admin)</a>
                    <a href="{{ route('buyer.dashboard') }}" class="block px-4 py-2">Buyer Dashboard (as admin)</a>
                    @elseif(auth()->user()->role == 1)
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Admin Dashboard</a>
                    @elseif(auth()->user()->role == 2)
                        <a href="{{ route('seller.dashboard') }}" class="hover:text-gray-300">Seller Dashboard</a>
                    @elseif(auth()->user()->role == 3)
                        <a href="{{ route('buyer.dashboard') }}" class="hover:text-gray-300">Buyer Dashboard</a>
                    @endif

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-gray-300 font-medium">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                    @endif
                @endauth
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-6 py-8 min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-6 text-center text-sm">
            © {{ date('Y') }} <strong>MultiVendorHub</strong>. All rights reserved.
            <div class="mt-2">
                <a href="#" class="hover:underline mx-2">Privacy</a>
                <a href="#" class="hover:underline mx-2">Terms</a>
                <a href="#" class="hover:underline mx-2">Support</a>
            </div>
        </div>
    </footer>

</body>
</html>