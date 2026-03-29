<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    //
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        // Find the job by its ID, or throw a 404 error if not found
        $job = Job::findOrFail($id);

        // Pass the job data to a view (e.g., resources/views/jobs/show.blade.php)
        return view('jobs.show', compact('job'));
    }
}
