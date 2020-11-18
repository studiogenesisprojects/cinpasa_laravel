<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsCommon extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Filtrar por',
            'ca' => 'Filtrar per',
            'en' => 'Filter by',
            'fr' => 'Filtrer par',
            'it' => 'Filtrare per',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'titulo_filtro',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'MOSTRAR TODOS',
            'ca' => 'MOSTRA TOT',
            'en' => 'MONTRER TOUT',
            'fr' => 'SHOW ALL',
            'it' => 'MOSTRA TUTTO',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'motrar_todos',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'O filtra por categoría',
            'ca' => 'O filtra per categoria',
            'en' => 'Or filter by category',
            'fr' => 'Ou filtrer par catégorie',
            'it' => 'Oppure filtrare per categoria',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'filtro_por_categoria',
            'text' => $textos
        ]);


        $textos = [
            'es' => 'INICIO',
            'ca' => 'INICI',
            'en' => 'HOME',
            'fr' => 'ACCUEIL',
            'it' => 'CASA',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'ruta_navegacion_inicio',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'PEDIR INFORMACIÓN',
            'ca' => 'DEMANAR INFORMACIÓ',
            'en' => 'REQUEST INFORMATION',
            'fr' => "DEMANDE D'INFORMATION",
            'it' => 'RICHIESTA INFORMAZIONI',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'ruta_navegacion_informacion',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Buscando',
            'ca' => 'Buscan',
            'en' => 'Searching',
            'fr' => "Recherche",
            'it' => 'Cercando',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'cargando_mensage1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Sin resultados',
            'ca' => 'Sense resultats',
            'en' => 'No results',
            'fr' => "Aucun résultat",
            'it' => 'Nessun risultato',
        ];

        LanguageLine::create([
            'group' => 'Comun',
            'key' => 'cargando_sin_resultados',
            'text' => $textos
        ]);
    }
}