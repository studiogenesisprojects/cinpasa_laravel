<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $textos = [
            'es' => 'Hemos encontrado estos productos:',
            'ca' => 'Hem trobat aquests productes:',
            'en' => 'We found these products:',
            'fr' => 'Nous avons trouvé ces produits :',
            'it' => 'Abbiamo trovato questi prodotti:',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'buscador_productos_titulo',
            'text' => $textos
        ]);
        $textos = [
            'es' => 'Pídenos más información de estos productos',
            'ca' => "Demana'ns més informació d'aquests productes",
            'en' => 'Ask us for more information about these products',
            'fr' => "Demandez-nous plus d'informations sur ces produits",
            'it' => 'Richiedi maggiori informazioni su questi prodotti',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'titulo_formulario',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Todas las categorías de nuestros productos',
            'ca' => 'Totes les categories dels nostres productes',
            'en' => 'All categories of our products',
            'fr' => 'Toutes les catégories de nos produits',
            'it' => 'Tutte le categorie dei nostri prodotti',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'categorías disponibles',
            'ca' => 'categories disponibles',
            'en' => 'available categories',
            'fr' => 'catégories disponibles',
            'it' => 'categorie disponibili',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'categorias_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿NECESITAS MÁS INFORMACIÓN?',
            'ca' => 'NECESSITES MÉS INFORMACIÓ?',
            'en' => 'NEED MORE INFORMATION?',
            'fr' => "BESOIN DE PLUS D'INFORMATIONS ?",
            'it' => 'HAI BISOGNO DI MAGGIORI INFORMAZIONI?',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'productos_mas_info_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'productos disponibles',
            'ca' => 'productes disponibles',
            'en' => 'available products',
            'fr' => 'produits disponibles',
            'it' => 'prodotti disponibili',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'productos_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'DESCRIPCIÓN',
            'ca' => 'DESCRIPCIÓ',
            'en' => 'DESCRIPTION',
            'fr' => 'DESCRIPTION',
            'it' => 'DESCRIZIONE',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_descripcion',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Añadir a favoritos',
            'ca' => 'Afegir a favorits',
            'en' => 'Add to favorites',
            'fr' => 'Ajouter aux favoris',
            'it' => 'Aggiungi ai preferiti',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_favoritos',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Eliminar de favoritos',
            'ca' => 'Eliminar de favorits',
            'en' => 'Delete from favorites',
            'fr' => 'Supprimer des favoris',
            'it' => 'Elimina dai preferiti',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_no_favorito',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'compartir',
            'ca' => 'compartir',
            'en' => 'share',
            'fr' => 'partager',
            'it' => 'azione',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_compartir',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'CARACTERÍSTICAS',
            'ca' => 'CARACTERÍSTIQUES',
            'en' => 'FEATURES',
            'fr' => 'TRAITS',
            'it' => 'TRAIT',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_caracteristicas',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Tipos:',
            'ca' => 'Tipus:',
            'en' => 'Types:',
            'fr' => 'Types :',
            'it' => 'Tipi:',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_tipo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Forma:',
            'ca' => 'Forma:',
            'en' => 'Form:',
            'fr' => 'Forme :',
            'it' => 'Forma:',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_forma',
            'text' => $textos
        ]);
        $textos = [
            'es' => 'Trenzado:',
            'ca' => 'Trenat:',
            'en' => 'Braided:',
            'fr' => 'Tressé :',
            'it' => 'Intrecciato:',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_trenzado',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Materiales:',
            'ca' => 'Materials:',
            'en' => 'Materials:',
            'fr' => 'Matériaux:',
            'it' => 'Materiali:',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_materiales',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'REFERENCIAS Y DIÁMETROS',
            'ca' => 'REFERENCIÈS I DIÀMETRES',
            'en' => 'REFERENCES AND DIAMETERS',
            'fr' => 'RÉFÉRENCES ET DIAMÈTRES',
            'it' => 'RIFERIMENTI E DIAMETRI',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_referencias',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Tamaños disponibles:',
            'ca' => 'Tamany disponible:',
            'en' => 'Available sizes:',
            'fr' => 'Tailles disponibles :',
            'it' => 'Dimensioni disponibili:',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_tamaños',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'COLORES',
            'ca' => 'COLORS',
            'en' => 'COLORS',
            'fr' => 'COULEURS',
            'it' => 'COLORI',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_colores',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Color natural de la materia. Muestrario de los colores naturales de la materia. Los materiales como el yute, el sisal u otros materiales naturales tiene como muestrario su color natural.',
            'ca' => 'Color natural de la matèria. Mostrari dels colors naturals de la matèria. Els materials com el jute, el sisal o altres materials naturals té com a mostrari el seu color natural.',
            'en' => 'Natural color of matter. Sample of the natural colors of the matter. Materials such as jute, sisal or other natural materials have as a sample its natural color.',
            'fr' => "Couleur naturelle de la matière. Echantillon des couleurs naturelles de la matière. Les matériaux tels que le jute, le sisal ou d'autres matériaux naturels ont comme échantillon sa couleur naturelle.",
            'it' => 'Colore naturale della materia. Campione dei colori naturali della materia. Materiali come juta, sisal o altri materiali naturali hanno come campione il suo colore naturale.',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_colores_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Este producto dispone de los siguientes colores, hiciera clic para mayor información',
            'ca' => 'Aquest producte disposa dels següents colors, fes clic per a més informació',
            'en' => 'This product has the following colors, click for more information',
            'fr' => "Ce produit a les couleurs suivantes, cliquez pour plus d'informations",
            'it' => 'Questo prodotto ha i seguenti colori, clicca per maggiori informazioni',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_colores_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'ACABADOS',
            'ca' => 'ACABATS',
            'en' => 'ENDINGS',
            'fr' => 'FINIT',
            'it' => 'FINITURE',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_acabados',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'APLICACIONES',
            'ca' => 'APLICACIONS',
            'en' => 'APPLICATIONS',
            'fr' => 'APPLICATIONS',
            'it' => 'APPLICAZIONI',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_aplicaciones',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Productos relacionados',
            'ca' => 'Productes relacionats',
            'en' => 'Related Products',
            'fr' => 'Produits connexes',
            'it' => 'Prodotti correlati',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_mostrar_relacionados',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos más información de este producto',
            'ca' => "Demana'ns més informació d'aquest producte",
            'en' => 'Ask us for more information about this product',
            'fr' => "Demandez-nous plus d'informations sur ce produit",
            'it' => 'Richiedi maggiori informazioni su questo prodotto',
        ];

        LanguageLine::create([
            'group' => 'Productos',
            'key' => 'producto_formulario_titulo',
            'text' => $textos
        ]);
    }
}