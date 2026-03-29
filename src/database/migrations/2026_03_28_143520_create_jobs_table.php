<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            
            // 1. Links this job to the employer's account in the users table
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            
            $table->string('job_title');
            $table->text('description');
            $table->boolean('minimum_wage_compliant')->default(false);
            
            // 2. Stores the multiple checkbox values as a JSON array
            $table->json('accessibility_features')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};