<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Factories\EventFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /*\App\Models\User::factory()->create([
            'name' => 'James Geiger',
            'email' => 'james@lavande.in',
        ]);
        */

        //\App\Models\Event::factory(5)->create();

        \App\Models\Person::factory(20)->create();
    }
}
