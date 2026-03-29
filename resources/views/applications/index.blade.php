@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-800">
    My Applications
</h2>

<div class="space-y-4">

@foreach($applications as $app)
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h3 class="text-lg font-semibold text-gray-800">
            {{ $app->job->job_title }}
        </h3>

        <p class="text-gray-600">
            {{ $app->job->company_name }}
        </p>

        <p class="mt-3 text-sm text-blue-600 font-medium">
            Status: {{ $app->status }}
        </p>

    </div>
@endforeach

</div>

@endsection