@extends('layouts.app')

@section('title', $job->job_title . ' | Abilidado Cebu')

@section('content')
<div class="max-w-4xl mx-auto pb-12">

    <a href="/jobs" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 mb-6 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Jobs
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="p-8 border-b border-gray-100">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                {{ $job->job_title }}
            </h1>
            
            <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500">
                <span class="flex items-center font-medium text-gray-900">
                    <svg class="w-5 h-5 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    {{ $job->employer->name }}
                </span>
                <span>•</span>
                <span class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Posted {{ $job->created_at->diffForHumans() }}
                </span>
            </div>

            <div class="flex flex-wrap gap-2 mt-6">
                @if($job->minimum_wage_compliant)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                        <svg class="w-3.5 h-3.5 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Minimum Wage Compliant
                    </span>
                @endif

                @if(!empty($job->accessibility_features))
                    @foreach($job->accessibility_features as $feature)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ ucwords(str_replace('_', ' ', $feature)) }}
                        </span>
                    @endforeach
                @endif
            </div>
            <span class="flex items-center font-bold text-emerald-600 mt-5">
                ₱{{ number_format($job->salary, 2) }} / month
            </span>
        </div>
        

        <div class="p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">About the Role</h3>
            <div class="text-gray-600 leading-relaxed whitespace-pre-line">
                {{ $job->description }}
            </div>
        </div>

        <div class="p-8 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h4 class="text-lg font-bold text-gray-900">Ready to join the team?</h4>
                <p class="text-sm text-gray-500 mt-1">Applying will send your Abilidado profile and verified PWD status to the employer.</p>
            </div>
            
            <form action="/apply/{{ $job->id }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Apply Now
                </button>
            </form>
        </div>

    </div>
</div>
@endsection