@extends('layouts.app')

@section('title', 'Employer Dashboard | Abilidado Cebu')

@section('content')
<div class="max-w-6xl mx-auto pb-12">
    
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Employer Dashboard
            </h2>
            <p class="text-gray-500 mt-2">Manage your job listings and track your inclusive hiring incentives.</p>
        </div>
        <button onclick="document.getElementById('postJobModal').classList.remove('hidden')" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-sm">
            + Post New Job
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <div class="text-sm font-medium text-gray-500 mb-1">Active Job Posts</div>
            <div class="text-4xl font-extrabold text-gray-900">{{ $activeJobsCount }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <div class="text-sm font-medium text-gray-500 mb-1">Total Applicants</div>
            <div class="text-4xl font-extrabold text-indigo-600">{{ $totalApplicants }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
            <div class="text-sm font-medium text-gray-500 mb-1">Verified PWD Hires</div>
            <div class="text-4xl font-extrabold text-blue-600">{{ $hiredCount }}</div>
        </div>

        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-6 rounded-2xl shadow-sm border border-emerald-100 relative overflow-hidden">
            <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-emerald-100 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            
            <div class="relative z-10">
                <div class="text-xs font-bold text-emerald-800 mb-1 uppercase tracking-wider">Est. Tax Deduction</div>
                
                <div class="text-3xl font-extrabold text-emerald-600 mb-1">
                    ₱{{ number_format($taxIncentive, 0) }}
                </div>
                
                <div class="text-[10px] text-emerald-700 font-medium flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    25% under RA 10524
                </div>
            </div>
        </div>

    </div>
     <div class="mb-10">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Your Recent Postings</h3>
        
        @if($recentJobs->isEmpty())
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
                <p class="text-gray-500">You haven't posted any jobs yet. Click "Post New Job" to get started.</p>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <ul class="divide-y divide-gray-100">
                    @foreach($recentJobs as $job)
                        <li class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $job->job_title }}</h4>
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $job->description }}</p>
                                    
                                    <div class="mt-3 flex gap-2">
                                        <span class="text-xs font-medium bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">
                                            Posted {{ $job->created_at->diffForHumans() }}
                                        </span>
                                        @if($job->minimum_wage_compliant)
                                            <span class="text-xs font-medium bg-green-50 text-green-700 px-2.5 py-1 rounded-md">
                                                Minimum Wage
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <button class="text-sm font-medium text-gray-400 hover:text-blue-600">Edit</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div id="postJobModal" class="mb-10 hidden bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900">Create New Job Listing</h3>
            <button onclick="document.getElementById('postJobModal').classList.add('hidden')" class="text-gray-400 hover:text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="/employer/jobs" method="POST" >
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 ">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                    <input type="text" name="job_title" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Monthly Salary (PHP)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">₱</span>
                            <input type="number" name="salary" step="0.01" class="w-full pl-8 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="0.00" required>
                        </div>
                        <p class="text-[10px] text-blue-600 mt-1">Current Cebu Minimum: ~₱13,130.00</p>
                    </div>
                    
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                    <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                </div>

                <div class="col-span-1 border border-gray-200 p-4 rounded-xl bg-gray-50">
                    <h4 class="font-semibold text-gray-800 mb-2">Compensation</h4>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="minimum_wage_compliant" value="1" class="mt-1 w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                        <div>
                            <span class="block font-medium text-gray-900">Minimum Wage Compliant</span>
                            <span class="block text-xs text-gray-500">I certify this position meets or exceeds the DOLE regional minimum wage.</span>
                        </div>
                    </label>
                </div>

                <div class="col-span-1 border border-gray-200 p-4 rounded-xl bg-gray-50">
                    <h4 class="font-semibold text-gray-800 mb-2">Accessibility Audit</h4>
                    <p class="text-xs text-gray-500 mb-3">Check all facilities available at the workplace to help match with the right candidates.</p>
                    
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="accessibility[]" value="wheelchair_ramp" class="text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Wheelchair Ramps & Elevators</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="accessibility[]" value="accessible_restroom" class="text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm text-gray-700">PWD-Accessible Restrooms</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="accessibility[]" value="sign_language" class="text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Sign Language Interpreter / Basic ASL Staff</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="accessibility[]" value="wfh" class="text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Work-From-Home Option</span>
                        </label>
                    </div>
                </div>
            </div>
            

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Publish Job Listing
                </button>
            </div>
        </form>
    </div>
    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif
</div>
@endsection