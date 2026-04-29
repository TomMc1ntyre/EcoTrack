<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'exampleadmin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => 'admin',
                'role' => 'admin',
            ]
        );

        $categories = [
            ['name' => 'Recycled',          'description' => 'Recycled materials properly',          'points' => 10, 'icon' => '♻️'],
            ['name' => 'Composted',         'description' => 'Composted organic waste',               'points' => 15, 'icon' => '🌱'],
            ['name' => 'Reduced Plastic',   'description' => 'Avoided single-use plastic',           'points' => 10, 'icon' => '🚫'],
            ['name' => 'Used Reusable Bag', 'description' => 'Used a reusable bag',                  'points' => 5,  'icon' => '🛍️'],
            ['name' => 'Public Transport',  'description' => 'Used public transportation',           'points' => 10, 'icon' => '🚌'],
            ['name' => 'Walked/Biked',      'description' => 'Walked or biked instead of driving',   'points' => 10, 'icon' => '🚶'],
            ['name' => 'Saved Energy',      'description' => 'Turned off lights/appliances',         'points' => 5,  'icon' => '💡'],
            ['name' => 'Water Conservation','description' => 'Saved water',                          'points' => 5,  'icon' => '💧'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
