<?php

use App\Models\Carousel;
use App\Models\Language;
use App\Models\Slide;
use App\Models\SlideLang;
use Illuminate\Database\Seeder;

class CarrouselSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [2, 7, 8, 9, 16, 17, 18];
        $faker = Faker\Factory::create();
        foreach (range(0, 6) as $index) {

            $carousel = Carousel::create([
                'name' => $faker->name,
                'active' => 1,
                'main' => 1,
                'section_id' => $array[$index],
            ]);
            $slide = Slide::create([
                'carousel_id' => $carousel->id,
                'url' => $faker->text,
                'main' => 1,
                'image' => 'img/100years.jpg',
            ]);

            foreach (Language::all() as $idioma) {
                SlideLang::create([
                    'language_id' => $idioma->id,
                    'slide_id' => $slide->id,
                    'alt_img' => $faker->text,
                    'title' => $faker->name(2),
                    'title_url' => $faker->text,
                    'text' => $faker->text(10),
                    'active' => 1,
                ]);
            }
            if ($index != 3) {

                $slide = Slide::create([
                    'carousel_id' => $carousel->id,
                    'url' => $faker->text,
                    'main' => 0,
                    'image' => $faker->text,
                ]);

                foreach (Language::all() as $idioma) {
                    SlideLang::create([
                        'language_id' => $idioma->id,
                        'slide_id' => $slide->id,
                        'alt_img' => $faker->text,
                        'title' => $faker->name(2),
                        'title_url' => $faker->text,
                        'text' => $faker->text(10),
                        'active' => 1,
                    ]);
                }
            }
        }
    }
}
