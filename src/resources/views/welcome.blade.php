<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abilidado Cebu | Inclusive Hiring Portal</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

    <header class="bg-white border-b border-gray-100 shadow-sm sticky top- z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-xl">
                    A
                </div>
                <span class="text-xl font-extrabold tracking-tight text-blue-600">
                    Abilidado Cebu
                </span>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        @if(auth()->user()->role === 'employer')
                            <a href="{{ url('/employer/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors">Go to Dashboard</a>
                        @else
                            <a href="{{ url('/jobs') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors">Browse Jobs</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <div class="hidden sm:flex items-center gap-2 border-l border-gray-200 pl-4 ml-2">
                                <a href="{{ route('register') }}" class="text-sm font-semibold px-4 py-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                    Job Seeker Sign Up
                                </a>
                                <a href="{{ url('/register/employer') }}" class="text-sm font-semibold px-4 py-2 text-white bg-gray-900 hover:bg-gray-800 rounded-lg shadow-sm transition-colors">
                                    Employer Sign Up
                                </a>
                            </div>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-15">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-700 text-sm font-bold tracking-wider uppercase mb-6 border border-blue-200">
                Cebu's Premier Inclusive Job Board
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                Empowering Abilities.<br>
                <span class="text-blue-600">Building Inclusive Workplaces.</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-500 mb-10 leading-relaxed">
                Connecting Persons with Disabilities (PWDs) to equal-opportunity employers in Cebu. Verified profiles. Accessible workplaces. Guaranteed minimum wage.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/jobs" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all text-lg">
                    Find a Job
                </a>
                <a href="/register/employer" class="w-full sm:w-auto px-8 py-4 bg-white text-gray-900 font-bold rounded-xl border-2 border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all text-lg">
                    Post a Job (Employers)
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Needs-First Search</h3>
                <p class="text-gray-500 leading-relaxed">
                    Don't just search by job title. Filter opportunities by workplace accessibility, wheelchair ramps, sign language support, and WFH availability.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Verified PWD Profiles</h3>
                <p class="text-gray-500 leading-relaxed">
                    Our built-in OCR technology securely verifies local government PWD IDs, ensuring employers are connecting with authentic candidates.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">RA 10524 Tax Tracking</h3>
                <p class="text-gray-500 leading-relaxed">
                    Employers unlock an automated dashboard that tracks inclusive hires and calculates the 25% BIR tax deduction incentive in real-time.
                </p>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Abilidado Cebu. Built for an inclusive future.
        </div>
    </footer>

</body>
</html>