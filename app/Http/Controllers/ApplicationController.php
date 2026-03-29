<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
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
