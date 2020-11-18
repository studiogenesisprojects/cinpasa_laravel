<?php

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            "Escritorio",
            "Inicio",
            "Slides",
            "Productos",
            "Favoritos",
            "Peticiones",
            "Aplicaciones",
            "Acabados",
            "Materiales",
            "Noticias",
            "Ofertas de trabajo",
            "Clientes",
            "Traducciones",
            "Textos legales",
            "Configuración",
            "Empresa",
            "Colores",
            "Contacta",
            "Actualidad",
        ] as $name) {
            Section::create([
                "name" => $name,
                "carousel_id" => null
            ]);
        }
    }
}