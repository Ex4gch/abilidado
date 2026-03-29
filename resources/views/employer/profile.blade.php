@extends('layouts.app')

@section('title', 'Company Profile | Abilidado Cebu')

@section('content')
<div class="max-w-3xl mx-auto pb-12">
    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">
        Company Profile
    </h2>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        
        <div class="flex items-center justify-between mb-8">
            <div class="space-y-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Company Name</span>
                    <p class="text-xl text-gray-900 font-bold">{{ $user->name }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Work Email</span>
                    <p class="text-lg text-gray-900">{{ $user->email }}</p>
                </div>
            </div>
            
            <div class="h-24 w-24 bg-blue-50 text-blue-300 rounded-xl flex items-center justify-center border-2 border-blue-100 border-dashed">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
        </div>

        <hr class="my-8 border-gray-100">

        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Business Verification</h3>
            <p class="text-sm text-gray-500 mb-6">Verify your business to display the "Inclusive Employer" badge on your job listings and qualify for RA 10524 tax incentives.</p>

            <div class="inline-flex items-center px-4 py-3 rounded-lg bg-yellow-50 border border-yellow-200 mb-4 w-full">
                <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <span class="text-yellow-800 font-medium block">Action Required: Upload Business Permit</span>
                    <span class="text-yellow-700 text-xs mt-0.5 block">Your account is active, but unverified listings may appear lower in search results.</span>
                </div>
            </div>

            <button class="mt-2 flex items-center justify-center w-full py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Upload Business Documents
            </button>
        </div>

    </div>
</div>
@endsection