@extends('layouts.app')

@section('title', 'Review Applicants | Abilidado Cebu')

@section('content')
<div class="max-w-6xl mx-auto pb-12">
    
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Applicant Tracking</h2>
            <p class="text-gray-500 mt-2">Review candidates and manage your inclusive hiring pipeline.</p>
        </div>
        <a href="/employer/dashboard" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
            &larr; Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">
            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if($applications->isEmpty())
        <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 p-12 text-center">
            <h3 class="text-lg font-semibold text-gray-900">No applicants yet</h3>
            <p class="text-gray-500 mt-1">Applications will appear here once job seekers start applying to your active postings.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Candidate</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Applied Role</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Current Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($applications as $app)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $app->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $app->user->email }}</div>
                                    
                                    @if($app->user->is_pwd)
                                        <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Verified PWD ID
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $app->job->job_title }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">Applied {{ $app->created_at->format('M d, Y') }}</div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                            'reviewed' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'accepted' => 'bg-green-50 text-green-700 border-green-200',
                                            'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border uppercase tracking-wider {{ $statusColors[$app->status] ?? 'bg-gray-100' }}">
                                        {{ $app->status }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($app->status !== 'accepted')
                                        <form action="/employer/applications/{{ $app->id }}/status" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="text-xs font-bold px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 hover:text-green-800 rounded-md transition-colors border border-green-200">
                                                Accept
                                            </button>
                                        </form>
                                        @endif

                                        @if($app->status !== 'rejected')
                                        <form action="/employer/applications/{{ $app->id }}/status" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-xs font-bold px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-800 rounded-md transition-colors border border-red-200">
                                                Reject
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection