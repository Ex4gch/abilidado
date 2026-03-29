@extends('layouts.app')

@section('content')

<div class="bg-white p-8 rounded-xl shadow-sm border max-w-3xl">

    <h2 class="text-2xl font-bold text-gray-800">
        {{ $job->job_title }}
    </h2>

    <p class="text-gray-600 mt-2">
        {{ $job->company_name }}
    </p>

    <p class="mt-6 text-gray-700">
        {{ $job->description }}
    </p>

    <form action="/apply/{{ $job->id }}" method="POST" class="mt-6">
        @csrf
        <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            Apply for this Job
        </button>
    </form>

</div>

@endsection