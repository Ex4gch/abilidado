<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    //
    public function index(Request $request)
    {
        // 1. Start with a base query, eager loading the employer to keep it fast
        $query = Job::with('employer')->latest();

        // 2. INTERFACE 1: Traditional Keyword Search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('job_title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  // Search by company name through the relationship
                  ->orWhereHas('employer', function($empQuery) use ($searchTerm) {
                      $empQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // 3. INTERFACE 2: Accessibility & Needs-Based Search
        
        // Filter for Minimum Wage
        if ($request->filled('minimum_wage')) {
            $query->where('minimum_wage_compliant', true);
        }

        // Filter for specific Accessibility Features (reads the JSON array)
        if ($request->filled('accessibility')) {
            foreach ($request->accessibility as $feature) {
                // Laravel's magic method for searching inside JSON columns
                $query->whereJsonContains('accessibility_features', $feature);
            }
        }

        // 4. Execute the query and paginate the results (10 per page)
        $jobs = $query->paginate(10);

        // Keep the search parameters in the URL so pagination works with filters applied
        $jobs->appends($request->all());

        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        // Find the job by its ID, or throw a 404 error if not found
        $job = \App\Models\Job::with('employer')->findOrFail($id);
        
        return view('jobs.show', compact('job'));

    }
}
