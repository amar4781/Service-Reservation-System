<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Career Coaching Session', 'description' => 'One-on-one guidance to help you define and achieve your career goals.', 'price' => 500],
            ['name' => 'Life Coaching Session', 'description' => 'Support to help you gain clarity, confidence, and direction in life.', 'price' => 400],
            ['name' => 'Fitness Coaching', 'description' => 'Customized fitness planning and motivation with a personal coach.', 'price' => 350],
            ['name' => 'Business Strategy Session', 'description' => 'Coaching for entrepreneurs to develop effective business strategies.', 'price' => 600],
            ['name' => 'Stress Management Coaching', 'description' => 'Learn techniques to manage stress and improve your mental wellbeing.', 'price' => 300],
            ['name' => 'Public Speaking Coaching', 'description' => 'Boost your confidence and skill in public presentations.', 'price' => 450],
            ['name' => 'Relationship Coaching', 'description' => 'Improve communication and connection in your relationships.', 'price' => 400],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
