<?php

namespace App\Console\Commands;

use App\Models\LanguageLine;
use Illuminate\Console\Command;

class SectionSeo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tradseo';

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
        $sections = [
            "Empresa" => "Empresa",
            "Productos" => "Productos",
            "Acabados" => "Acabados",
            'Aplicaciones' => 'Aplicaciones',
            "Materiales" => "Materiales",
            "Colores" => "Colores",
            "Noticias" => "Noticias",
            "Contacta" => "Contacto",
        ];

        foreach ($sections as $key => $section) {

            $line = LanguageLine::where('key', $key)->first();
            $titles = json_decode($line->text);

            if ($titles) {
                $ll = LanguageLine::where('group', $section)->first();
                $descriptions = LanguageLine::where('group', $section)->where('key', 'seccion1_texto')->first();
                if ($ll) {
                    LanguageLine::create([
                        "group"  => $section,
                        "key" => "meta-title",
                        "text" => '{"es":"' . $titles->es . '","ca":"' . $titles->ca . '","en":"' . $titles->en . '","fr":"' . $titles->fr . '","it":"' . $titles->it . '"}'
                    ]);
                    if ($descriptions) {
                        $desc = json_decode($descriptions->text);
                        LanguageLine::create([
                            "group"  => $section,
                            "key" => "meta-description",
                            "text" => '{"es":"' . $desc->es . '","ca":"' . $desc->ca . '","en":"' . $desc->en . '","fr":"' . $desc->fr . '","it":"' . $desc->it . '"}'
                        ]);
                    } else {
                        LanguageLine::create([
                            "group"  => $section,
                            "key" => "meta-description",
                            "text" => '{"es":"","ca":"","en":"","fr":"","it":""}'
                        ]);
                    }
                }
            }

            $this->alert($titles->es);
        }
    }
}
