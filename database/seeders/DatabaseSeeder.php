<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();
        Listing::factory(6)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    //     Listing::create([
    //         'title' => 'Laravel Fresher developer',
    //         'tags' => 'Laravel, Javascript',
    //         'company' => 'Acme Corp',
    //         'location' => 'Boston, MA',
    //         'email' => 'email1@email.com',
    //         'website' => 'https://www.acme.com',
    //         'description' => 'Lorem ipsum dolor sit amet'
    //     ]);
    //     Listing::create([
    //         'title' => 'Full-Stack developer',
    //         'tags' => 'backend, api, laravel',
    //         'company' => 'Stark Industries',
    //         'location' => 'Newyork, NY',
    //         'email' => 'email2@email.com',
    //         'website' => 'https://www.starkindustries.com',
    //         'description' => 'Lorem ipsum dolor sit amet'
    //     ]);
    // }
    }
}
