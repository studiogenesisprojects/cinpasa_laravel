<?php

namespace App\Console\Commands;

use App\Models\Finished;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixApplicationProductRelation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Cortado diagonal 
        $finisheds = [
            24820,
            24806,
            24811
        ];
        foreach ($finisheds as $finished) {
            $f  = Finished::find($finished);
            $f->products()->whereHas('categories', function ($q) {
                $q->whereHas('father', function ($q) {
                    $q->where('id', 25338);
                });
            })->each(function ($i) use ($finished) {
                $i->finisheds()->detach($finished);
            });
        }
        Product::whereHas('categories', function ($q) {
            $q->where('product_categories.id', 23500);
        })->each(function ($i) {
            $i->finisheds()->attach(61881);
        });

        $p = Product::whereHas('categories', function ($q) {
            $q->whereHas('father', function ($q) {
                $q->where('id', 25342);
            })->where('product_categories.id', '!=', 23510);
        })->each(function ($i) {
            $i->finisheds()->attach(51373);
        });
    }
}
