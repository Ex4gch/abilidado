@extends('layouts.app')

@section('title', 'Find Jobs | Abilidado Cebu')

@section('content')
<div class="max-w-5xl mx-auto pb-12">

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <form action="/jobs" method="GET" class="space-y-4">
            
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="block w-full pl-11 pr-4 py-3 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-gray-900 placeholder-gray-400" 
                    placeholder="Search by job title, company, or keywords...">
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-gray-50">
                
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-sm font-semibold text-gray-700">Must Include:</span>
                    
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="minimum_wage" value="1" class="rounded border-gray-300 text-green-600 focus:ring-green-500 w-4 h-4" {{ request('minimum_wage') ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700 font-medium">Minimum Wage Guarantee</span>
                    </label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="accessibility[]" value="wheelchair_ramp" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4" {{ in_array('wheelchair_ramp', request('accessibility', [])) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Wheelchair Access</span>
                    </label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="accessibility[]" value="sign_language" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4" {{ in_array('sign_language', request('accessibility', [])) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Sign Language Support</span>
                    </label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="accessibility[]" value="wfh" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4" {{ in_array('wfh', request('accessibility', [])) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Remote / WFH</span>
                    </label>
                </div>

                <button type="submit" class="px-5 py-2 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition-colors">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-900">
            {{ $jobs->total() }} {{ Str::plural('Job', $jobs->total()) }} Found
        </h2>
    </div>

    @if($jobs->isEmpty())
        <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 p-12 text-center">
            <h3 class="text-lg font-semibold text-gray-900">No jobs match your criteria</h3>
            <p class="text-gray-500 mt-1">Try adjusting your filters or searching for different keywords.</p>
            <a href="/jobs" class="mt-4 inline-block text-blue-600 font-medium hover:underline">Clear all filters</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($jobs as $job)
                <a href="/jobs/{{ $job->id }}" class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-300 hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $job->job_title }}</h3>
                            <p class="text-sm font-medium text-gray-600 mt-1">{{ $job->employer->name }}</p>
                        </div>
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">
                            ₱{{ number_format($job->salary, 0) }} / mo
                        </span>
                    </div>

                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                        {{ $job->description }}
                    </p>

                    <div class="flex flex-wrap gap-2 mt-auto">
                        @if($job->minimum_wage_compliant)
                            <span class="w-2 h-2 rounded-full bg-green-500" title="Minimum Wage Compliant"></span>
                        @endif
                        @if(!empty($job->accessibility_features))
                            @foreach($job->accessibility_features as $feature)
                                <span class="text-[10px] uppercase tracking-wider font-bold bg-gray-100 text-gray-600 px-2 py-0.5 rounded">
                                    {{ str_replace('_', ' ', $feature) }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $jobs->links() }}
        </div>
    @endif

</div>
@endsection