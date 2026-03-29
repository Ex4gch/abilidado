@extends('layouts.app')

@section('title', 'My Applications | Abilidado Cebu')

@section('content')
<div class="max-w-4xl mx-auto pb-12">
    
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">My Applications</h2>
            <p class="text-gray-500 mt-1">Keep track of your job hunt progress in Cebu.</p>
        </div>
        <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg text-sm font-bold">
            Total: {{ $applications->count() }}
        </div>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 p-12 text-center">
            <h3 class="text-lg font-semibold text-gray-900">No applications yet</h3>
            <p class="text-gray-500 mt-1 mb-6">Your dream job is waiting for you.</p>
            <a href="/jobs" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                Explore Jobs
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-300 transition-all group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        
                        <div class="flex-grow">
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    {{ $app->job->job_title }}
                                </h3>
                                <span class="text-[10px] uppercase tracking-widest font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded">
                                    Applied {{ $app->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <p class="text-gray-600 font-medium mt-1 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                {{ $app->job->employer->name }}
                            </p>
                        </div>

                        <div class="flex items-center">
                            @php
                                $status = strtolower($app->status);
                                $classes = [
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'reviewed' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'accepted' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                ][$status] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                            @endphp

                            <div class="flex items-center gap-2 px-4 py-2 rounded-xl border {{ $classes }} font-bold text-xs uppercase tracking-wider">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ str_replace('text', 'bg', explode(' ', $classes)[1]) }}"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 {{ str_replace('text', 'bg', explode(' ', $classes)[1]) }}"></span>
                                </span>
                                {{ $app->status }}
                            </div>
                        </div>

                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-end">
                        <a href="/jobs/{{ $app->job_id }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            View Original Posting
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection