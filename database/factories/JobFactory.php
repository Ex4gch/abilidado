<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'job_title' => $this->faker->randomElement([
                'Office Assistant',
                'Data Encoder',
                'Customer Service Representative',
                'Administrative Staff',
                'IT Support Assistant',
                'Clerk',
                'Front Desk Staff',
                'Online Chat Support',
                'Inventory Assistant',
                'Remote Data Entry Staff'
            ]),
            'description' => $this->faker->paragraph(3),
            'minimum_wage_compliant' => $this->faker->boolean(80), // 80% compliant
            'accessible_workplace' => $this->faker->boolean(70),   // 70% accessible
        ];
    }
}
