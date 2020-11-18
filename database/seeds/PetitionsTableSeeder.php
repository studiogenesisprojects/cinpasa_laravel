<?php

use Illuminate\Database\Seeder;
use App\Models\Petition; 

class PetitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(0, 4) as $i){
            Petition::create([
                "origen" => "test",
                "fullname" => "Aname Totest",
                "company" => "Company name",
                "email" => "test@test.com",
                "phone_number" => "test",
                "country" => "Spain",
                "comment" => "lorem ",
                "state" => 1 
            ]);
        }
    }
}
