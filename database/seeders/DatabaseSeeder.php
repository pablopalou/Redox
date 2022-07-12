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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user1 = new User();
        $user1->first_name = "Gerard";
        $user1->last_name = "Cremin";
        $user1->date_of_birth = "1989-12-25";
        $user1->ssn = "999-86-7555";
        $user1->gender = "male";
        $user1->address = "273 Farrell Village, Madison, WI 53558 USA";
        $user1->phone = "555-551-3549";
        $user1->email = "Gerard.Cremin-20@syntheamail.com";

        $user2 = new User();
        $user2->first_name = "Kelli";
        $user2->last_name = "Fritsch";
        $user2->date_of_birth = "2007-01-01";
        $user2->ssn = "999-88-7393";
        $user2->gender = "female";
        $user2->address = "853 Schinner Ramp, Madison, WI 53703 USA";
        $user2->phone = "555-140-2272";
        $user2->email = "Kelli.Fritsch-80@syntheamail.com";
        
        $user3 = new User();
        $user3->first_name = "Bobby";
        $user3->last_name = "Gottlieb";
        $user3->date_of_birth = "2010-06-04";
        $user3->ssn = "999-42-4700";
        $user3->gender = "male";
        $user3->address = "930 Strosin Parade, Madison, WI 53718 USA";
        $user3->phone = "555-887-6766";
        $user3->email = "Bobby.Gottlieb-51@syntheamail.com";
        
        $user4 = new User();
        $user4->first_name = "Calvin";
        $user4->last_name = "Hills";
        $user4->date_of_birth = "1989-08-16";
        $user4->ssn = "999-81-6372";
        $user4->gender = "male";
        $user4->address = "765 Dickinson Annex Unit 1, Madison, WI 53714 USA";
        $user4->phone = "555-757-8394";
        $user4->email = "Calvin.Hills-100@syntheamail.com";

        $user5 = new User();
        $user5->first_name = "Harriet";
        $user5->last_name = "Dare";
        $user5->date_of_birth = "1957-05-20";
        $user5->ssn = "999-38-8978";
        $user5->gender = "female";
        $user5->address = "554 Bechtelar Annex, Madison, WI 53715 USA";
        $user5->phone = "555-726-3278";
        $user5->email = "Harriet.Dare-44@syntheamail.com";


    }
}
