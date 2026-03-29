<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class EmployerController extends Controller
{
    public function dashboard()
    {
        // Security Check
        if (Auth::user()->role !== 'employer') {
            return redirect('/jobs')->with('error', 'Access denied. Employer account required.');
        }

        $employerId = Auth::id();

        // 1. Active Jobs Count & Recent Jobs List
        $activeJobsCount = \App\Models\Job::where('employer_id', $employerId)->count();
        $recentJobs = \App\Models\Job::where('employer_id', $employerId)->latest()->get();

        // NEW: Count ALL applications submitted to this employer's jobs
        $totalApplicants = \App\Models\Application::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })->count();

        // 2. Find 'accepted' applications for VERIFIED PWDs only (For Tax Math)
        $hiredApplications = \App\Models\Application::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })
        ->where('status', 'accepted')
        ->whereHas('user', function ($query) {
            $query->where('is_pwd', true); 
        })
        ->with('job') 
        ->get();

        $hiredCount = $hiredApplications->count();

        // 3. Calculate the RA 10524 Tax Deduction
        $taxIncentive = 0;
        foreach ($hiredApplications as $app) {
            $annualSalary = $app->job->salary * 12;
            $taxIncentive += ($annualSalary * 0.25);
        }

        // Make sure to pass $totalApplicants to the view!
        return view('employer.dashboard', compact(
            'activeJobsCount',
            'totalApplicants', 
            'hiredCount', 
            'taxIncentive',
            'recentJobs'
        ));
    }

   public function storeJob(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        // SMART FILTER: Check if salary meets Cebu Minimum Wage (~13,130)
        $isCompliant = $request->salary >= 13130;

        \App\Models\Job::create([
            'employer_id' => auth()->id(),
            'job_title' => $request->job_title,
            'salary' => $request->salary,
            'description' => $request->description,
            'minimum_wage_compliant' => $isCompliant, // Auto-calculated!
            'accessibility_features' => $request->accessibility ?? [],
        ]);

        return redirect('/employer/dashboard')->with('success', 'Job listing published successfully!');
    }

    public function applicants()
    {
        // Fetch all applications for jobs that belong to this specific employer
        $applications = \App\Models\Application::whereHas('job', function ($query) {
                $query->where('employer_id', auth()->id());
            })
            ->with(['user', 'job']) // Eager load the job seeker and the job details
            ->latest()
            ->get();

        return view('employer.applicants', compact('applications'));
    }

    // 2. Update the applicant's status
    public function updateApplicationStatus(Request $request, $applicationId)
    {
        $request->validate([
            'status' => 'required|in:reviewed,accepted,rejected'
        ]);

        // Find the application and ensure it belongs to a job this employer posted
        $application = \App\Models\Application::whereHas('job', function ($query) {
            $query->where('employer_id', auth()->id());
        })->findOrFail($applicationId);

        // Update the status
        $application->status = $request->status;
        $application->save();

        return back()->with('success', "Application status updated to " . ucfirst($request->status) . "!");
    }
}