@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">
        Job Listings
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($jobs as $job)
            <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                        {{ $job->job_title }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $job->company_name }}
                    </p>

                    <div class="mt-5 flex flex-wrap gap-2">
                        @if($job->minimum_wage_compliant)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                Wage Compliant
                            </span>
                        @endif

                        @if($job->accessible_workplace)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                PWD Accessible
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-50">
                    <a href="/jobs/{{ $job->id }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">
                        View Job Details
                        <svg class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</div>
@endsection