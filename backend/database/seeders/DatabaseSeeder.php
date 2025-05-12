<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
        ]);

        Event::create([
            'name' => 'Sample Event',
            'total_seats' => 20,
            'available_seats' => 20,
            'status' => 'in-progress',
        ]);

        Event::create([
            'name' => 'PHP Event',
            'total_seats' => 15,
            'available_seats' => 12,
            'status' => 'in-progress',
        ]);
        Event::create([
            'name' => 'Laravel Event',
            'total_seats' => 10,
            'available_seats' => 4,
            'status' => 'in-progress',
        ]);
    }
}
