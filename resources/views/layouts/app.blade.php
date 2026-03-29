<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Abilidado Cebu')</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-gray-50 antialiased text-gray-900 min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-xl font-extrabold tracking-tight text-blue-600 hover:text-blue-700 transition-colors">
                        Abilidado Cebu
                    </a>
                </div>

                <div class="hidden md:flex space-x-8">
                    @if(auth()->check() && auth()->user()->role === 'employer')
                        <a href="/employer/dashboard" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-blue-500 transition-all duration-200">
                            Employer Dashboard
                        </a>
                        <a href="/employer/applicants" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-blue-500 transition-all duration-200">
                            Review Applicants
                        </a>
                    @else
                        <a href="/jobs" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-blue-500 transition-all duration-200">
                            Jobs
                        </a>
                        <a href="/applications" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-blue-500 transition-all duration-200">
                            Applications
                        </a>
                    @endif
                </div>

                <div class="flex items-center space-x-6">
                    
                    <a href="/profile" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-1.5 group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>

                    <form action="/logout" method="POST" class="m-0 flex items-center">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors flex items-center gap-1.5 group">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-6xl mx-auto w-full mt-8 px-4 sm:px-6 lg:px-8 pb-12">
        @yield('content')
    </main>

</body>
</html>