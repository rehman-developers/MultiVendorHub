<!-- resources/views/subscribe.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Subscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .form-container {
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-50">
    <div
        class="w-full max-w-md form-container bg-white rounded-2xl p-8 border border-indigo-100 overflow-hidden relative">
        <!-- Decorative elements -->
        <div class="absolute -top-10 -right-10 w-20 h-20 bg-indigo-100 rounded-full opacity-70 animate-float"></div>
        <div class="absolute -bottom-8 -left-8 w-16 h-16 bg-indigo-100 rounded-full opacity-70 animate-float"
            style="animation-delay: 2s;"></div>

        <!-- Header -->
        <div class="text-center mb-8 relative z-10">
            <div
                class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-envelope-open-text text-white text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Stay In The Loop</h2>
            <p class="text-gray-500 text-sm max-w-xs mx-auto">
                Get the latest updates, exclusive offers, and helpful tips delivered to your inbox.
            </p>
        </div>

        <form action="{{ route('subscribe.submit') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            <!-- Name Field -->
            <div class="relative">
                <input type="text" name="name" id="name" placeholder="John Doe"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3.5 input-focus transition-all duration-200 bg-gray-50 focus:bg-white">
                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400"></i>
                </div> -->
            </div>

            <!-- Email Field -->
            <div class="relative">
                <input type="email" name="email" id="email" placeholder="you@example.com"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3.5 input-focus transition-all duration-200 bg-gray-50 focus:bg-white">
                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div> -->
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-semibold py-3.5 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                <i class="fas fa-paper-plane mr-2"></i>Subscribe Now
            </button>

            <!-- Errors -->
            @if ($errors->any())
            <div
                class="mt-4 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl p-4 transition-all duration-300">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span class="font-medium">Please fix the following errors:</span>
                </div>
                <ul class="mt-2 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>

        <!-- Footer note -->
        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">
                <i class="fas fa-shield-alt mr-1"></i>We respect your privacy. Unsubscribe anytime.
            </p>
        </div>
    </div>
</body>

</html>