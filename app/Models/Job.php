<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'job_title',
        'description',
        'minimum_wage_compliant',
        'accessibility_features',
    ];

    // This tells Laravel to handle the JSON array conversion automatically
    protected $casts = [
        'accessibility_features' => 'array',
        'minimum_wage_compliant' => 'boolean',
    ];

    // Connects the job to the employer
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}