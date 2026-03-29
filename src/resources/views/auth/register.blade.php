<x-guest-layout>

@section('title', 'Register | Abilidado Cebu')

@section('content')
    @endsection


    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 font-sans">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-blue-600 tracking-tight">Abilidado Cebu</h1>
            <p class="text-gray-500 mt-2 text-sm">Create your Job Seeker account.</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-sm border border-gray-100 overflow-hidden sm:rounded-2xl">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
                </div>

                <div class="pt-4 flex flex-col space-y-4">
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Create Account
                    </button>
                    
                    <div class="text-center text-sm text-gray-600">
                        Already registered? 
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                            Sign in here
                        </a>
                    </div>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Hiring for your company?
                </p>
                <a href="/register/employer" class="mt-1 inline-block text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors">
                    Create an Employer Account &rarr;
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>