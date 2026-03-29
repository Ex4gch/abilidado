<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    public function definition(): array
    {
        // Realistic job titles for the local market
        $titles = [
            'Customer Service Representative (Non-Voice)',
            'Junior Web Developer (Laravel)',
            'Data Entry Specialist',
            'Administrative Assistant',
            'Graphic Designer',
            'IT Support Staff',
            'Virtual Assistant',
            'Front Desk Receptionist'
        ];

        // The exact values from your HTML form's accessibility audit
        $features = ['wheelchair_ramp', 'accessible_restroom', 'sign_language', 'wfh'];

        return [
            // We'll assign the employer_id in the seeder, but this acts as a fallback
            'employer_id' => User::factory(), 
            
            'job_title' => fake()->randomElement($titles),
            
            // Generates 2 realistic paragraphs of text for the job description
            'description' => fake()->paragraphs(2, true),
            
            // 80% chance the job is minimum wage compliant
            'minimum_wage_compliant' => fake()->boolean(80),
            
            // Randomly picks 1 to 3 accessibility features for each job
            'accessibility_features' => fake()->randomElements($features, fake()->numberBetween(1, 3)),
        ];
    }
}