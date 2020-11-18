<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'Castellano',
            'code' => 'es',
            'status' => '1',
        ]);
        Language::create([
            'name' => 'Catalan',
            'code' => 'ca',
            'status' => '1',
        ]);
        Language::create([
            'name' => 'Ingles',
            'code' => 'en',
            'status' => '1',
        ]);
        Language::create([
            'name' => 'Frances',
            'code' => 'fr',
            'status' => '1',
        ]);
        Language::create([
            'name' => 'Italiano',
            'code' => 'it',
            'status' => '1',
        ]);
    }
}
