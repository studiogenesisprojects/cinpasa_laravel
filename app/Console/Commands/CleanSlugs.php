<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\MaterialLang;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CleanSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:slugs';

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
        MaterialLang::all()->each(function ($m) {
            $m->slug = Str::slug($m->slug);
            $m->save();
        });
    }
}
