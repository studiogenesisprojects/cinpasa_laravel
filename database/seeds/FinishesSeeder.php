<?php

use App\Models\Finished;
use App\Models\FinishedAplications;
use App\Models\FinishedGalery;
use App\Models\FinishedGaleryImage;
use App\Models\FinishedMaterial;
use App\Models\FinishedLang;
use App\Models\Language;
use Illuminate\Database\Seeder;

class FinishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 20) as $index) {

            $galery = FinishedGalery::create([
                'video' => 'https://www.youtube.com/watch?v=hC8CH0Z3L54&list=RDhC8CH0Z3L54&start_radio=1'
            ]);

            FinishedGaleryImage::create([
                'galery_id' => $galery->id,
                'image' => 'public/productos/test.jpg',
                'alt_image' => $faker->name
            ]);

            FinishedGaleryImage::create([
                'galery_id' => $galery->id,
                'image' => 'public/productos/test.jpg',
                'alt_image' => $faker->name
            ]);

            $finished = Finished::create([
                'galery_id' => $galery->id,
                'type_id' => 1,
                'form_id' => 1,
                'brided_id' => 1,
                'active' => 1,
                'order' => $index,
                'list_image' => 'public/productos/test.jpg',
                'section_image' => 'public/productos/test.jpg',
            ]);

            foreach (Language::all() as $language) {
                FinishedLang::create([
                    'language_id' => $language->id,
                    'finished_id' => $finished->id,
                    'name' => $faker->name,
                    'subtitle' => $faker->text(40),
                    'lite_description' => $faker->text(100),
                    'large_description' => $faker->text,
                    'observations' => $faker->text,
                    'slug' => $faker->text,
                ]);
            }

            FinishedMaterial::create([
                'material_id' => 1,
                'finished_id' => $finished->id
            ]);

            FinishedAplications::create([
                'aplication_id' => 1,
                'finished_id' => $finished->id,
                'order' => $index
            ]);
        }
    }
}