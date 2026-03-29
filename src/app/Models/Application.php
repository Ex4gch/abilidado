<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id', 'job_id', 'status'];

    // Link back to the Job Seeker
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Link back to the Job Posting
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}