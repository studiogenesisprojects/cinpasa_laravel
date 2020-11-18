<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Customer::create([
            'name' => 'munich',
            'web' => "#",
            'order' => 1,
            'logotype' => '/img/munich.jpg',
            'status' => 1
        ]);

        Customer::create([
            'name' => 'agatha',
            'web' => "#",
            'order' => 2,
            'logotype' => '/img/agatha.jpg',
            'status' => 1
        ]);
        Customer::create([
            'name' => 'sephora',
            'web' => "#",
            'order' => 3,
            'logotype' => '/img/sephora.jpg',
            'status' => 1
        ]);
        Customer::create([
            'name' => 'gucci',
            'web' => "#",
            'order' => 4,
            'logotype' => '/img/gucci.png',
            'status' => 1
        ]);
        Customer::create([
            'name' => 'yves',
            'web' => "#",
            'order' => 5,
            'logotype' => '/img/yves.png',
            'status' => 1
        ]);
        Customer::create([
            'name' => 'decathlon',
            'web' => "#",
            'order' => 6,
            'logotype' => '/img/decathlon.png',
            'status' => 1
        ]);
        Customer::create([
            'name' => 'mercadona',
            'web' => "#",
            'order' => 7,
            'logotype' => '/img/mercadona.jpg',
            'status' => 1
        ]);
        Customer::create([
            'name' => 'hermes',
            'web' => "#",
            'order' => 8,
            'logotype' => '/img/hermes.jpg',
            'status' => 1
        ]);
    }
}