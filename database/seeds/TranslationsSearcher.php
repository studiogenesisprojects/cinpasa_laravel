<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsSearcher extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Encuentra el producto que buscas:',
            'ca' => 'Troba el producte que cerques:',
            'en' => "Find the product you are looking for:",
            'fr' => 'Trouvez le produit que vous recherchez:',
            'it' => 'Trova il prodotto che stai cercando:',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'titulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'O filtra hasta encontrarlo: ',
            'ca' => 'O filtra fins a trobar-ho:',
            'en' => 'Or filter until you find it:',
            'fr' => "Ou filtrer jusqu'à ce que vous le trouviez:",
            'it' => 'O filtrare fino a quando non lo trovate:',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'titulo2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Materiales',
            'ca' => 'Materials',
            'en' => 'Materials',
            'fr' => 'Materiels',
            'it' => 'Materiali',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'materiales_placeholder',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nombre del producto',
            'ca' => 'Nom del producte',
            'en' => 'Product name',
            'fr' => 'Nom du produit',
            'it' => 'Nome del prodotto',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'producto_placeholder',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Colores',
            'ca' => 'Colors',
            'en' => 'Colors',
            'fr' => 'Couleurs',
            'it' => 'Colori',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'colores_placeholder',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Aplicaciones',
            'ca' => 'Aplicacios',
            'en' => 'Applications',
            'fr' => 'Candidatures',
            'it' => 'Applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'aplicaciones_placeholder',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Buscar',
            'ca' => 'Buscar',
            'en' => 'Search',
            'fr' => 'Rechercher',
            'it' => 'Ricerca',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'buscar_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ver resultados',
            'ca' => 'Veure resultats',
            'en' => 'See results',
            'fr' => 'Voir les résultats',
            'it' => 'Vedi i risultati',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'resultados_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Hemos encontrado ',
            'ca' => 'Hem trobat ',
            'en' => 'We found ',
            'fr' => 'Nous avons trouvé ',
            'it' => 'Abbiamo trovato ',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'productos_encontrados_parte1',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' productos con tu búsqueda',
            'ca' => ' productes amb la teva cerca',
            'en' => ' products with your search',
            'fr' => ' produits avec votre recherche',
            'it' => ' prodotti con la tua ricerca',
        ];

        LanguageLine::create([
            'group' => 'Buscador',
            'key' => 'productos_encontrados_parte2',
            'text' => $textos
        ]);
    }
}