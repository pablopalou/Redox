<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'first_name' => "Gerard",
            'last_name' => "Cremin",
            'date_of_birth' => "1989-12-25",
            'ssn' => "999-86-7555",
            'gender' => "male",
            'address' => "273 Farrell Village, Madison, WI 53558 USA",
            'phone' => "555-551-3549",
            'email' => "Gerard.Cremin-20@syntheamail.com",
        ]);

        User::factory()->create([
            'first_name' => "Kelli",
            'last_name' => "Fritsch",
            'date_of_birth' => "2007-01-01",
            'ssn' => "999-88-7393",
            'gender' => "female",
            'address' => "853 Schinner Ramp, Madison, WI 53703 USA",
            'phone' => "555-140-2272",
            'email' => "Kelli.Fritsch-80@syntheamail.com",
        ]);

        User::factory()->create([
            'first_name' => "Bobby",
            'last_name' => "Gottlieb",
            'date_of_birth' => "2010-06-04",
            'ssn' => "999-42-4700",
            'gender' => "male",
            'address' => "930 Strosin Parade, Madison, WI 53718 USA",
            'phone' => "555-887-6766",
            'email' => "Bobby.Gottlieb-51@syntheamail.com",
        ]);

        User::factory()->create([
            'first_name' => "Calvin",
            'last_name' => "Hills",
            'date_of_birth' => "1989-08-16",
            'ssn' => "999-81-6372",
            'gender' => "male",
            'address' => "765 Dickinson Annex Unit 1, Madison, WI 53714 USA",
            'phone' => "555-757-8394",
            'email' => "Calvin.Hills-100@syntheamail.com",
        ]);
        
        User::factory()->create([
            'first_name' => "Harriet",
            'last_name' => "Dare",
            'date_of_birth' => "1957-05-20",
            'ssn' => "999-38-8978",
            'gender' => "female",
            'address' => "554 Bechtelar Annex, Madison, WI 53715 USA",
            'phone' => "555-726-3278",
            'email' => "Harriet.Dare-44@syntheamail.com",
        ]);
    }
}
