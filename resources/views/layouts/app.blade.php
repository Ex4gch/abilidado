<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Abilidado Cebu</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800">
                Abilidado Cebu
            </h1>

            <div class="space-x-6">
                <a href="/jobs" class="text-gray-600 hover:text-blue-600">Jobs</a>
                <a href="/applications" class="text-gray-600 hover:text-blue-600">Applications</a>

                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button class="text-red-500 hover:text-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="max-w-6xl mx-auto mt-8 px-6">
        @yield('content')
    </div>

</body>
</html>