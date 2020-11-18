<?php

use Illuminate\Database\Seeder;
use App\Models\Aplication;
use App\Models\AplicationLang;
use App\Models\Language;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(0, 20) as $index) {
            $application = Aplication::create([
                'order' => $index,
                'sup_aplication' =>  $index > 0 ? 1 : null,
            ]);
            foreach (Language::all() as $language) {
                AplicationLang::create([
                    'language_id' => $language->id,
                    'aplication_id' => $application->id,
                    'name' => $faker->name(2),
                    'slug' => $faker->slug,
                    'subtitle' => $faker->name(4),
                    'lite_description' => $faker->text(100),
                    'description' => $faker->text,
                    'order' => $index,
                    'image_alt' => $faker->word
                ]);
            }
        }
    }
}