<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{

    public function index()
    {
        $applications = Application::with(['job.employer'])
            ->where('user_id', Auth::id())
            ->get();

        // REMOVE THIS after testing. It will stop the page and show you the data.
        // dd($applications); 

        return view('applications.index', compact('applications'));
    }
    //
    public function apply($id)
    {
        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $id,
            'status' => 'Pending'
        ]);

        return redirect('/jobs')->with('success', 'Application submitted!');
    }

    
}
