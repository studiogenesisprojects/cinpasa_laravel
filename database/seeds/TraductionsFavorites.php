<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsFavorites extends Seeder
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
            'es' => 'Favoritos',
            'ca' => 'Favorits',
            'en' => 'Favourites',
            'fr' => 'Favoris',
            'it' => 'Preferiti',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Aquí puedes ver una lista de los productos que has marcado como preferidos.',
            'ca' => 'Aquí pots veure una llista dels productes que has marcat com preferits.',
            'en' => 'Here you can see a list of the products that you have marked as preferred.',
            'fr' => 'Ici vous pouvez voir une liste des produits que vous avez marqués comme préférés.',
            'it' => "Qui potete vedere l'elenco dei prodotti che avete contrassegnato come preferiti.",
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Quieres recibir información de estos productos?',
            'ca' => "Vols rebre informació d'aquests productes?",
            'en' => 'Would you like to receive information about these products?',
            'fr' => "Souhaitez-vous recevoir des informations sur ces produits ?",
            'it' => 'Vuoi ricevere informazioni su questi prodotti?',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Puedes pedirnos información de todos o de una selección de los productos que tengas en esta lista de preferidos.',
            'ca' => "Pots demanar-nos informació de tots o d'una selecció dels productes que tinguis en aquesta llista de preferits.",
            'en' => 'You can ask us for information on all or a selection of the products you have in this list of favorites.',
            'fr' => "Vous pouvez nous demander des informations sur l'ensemble ou une sélection des produits que vous avez dans cette liste de favoris.",
            'it' => 'Puoi chiederci informazioni su tutti o su una selezione dei prodotti che hai in questo elenco di preferiti.',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'seccion1_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Haz clic en el siguiente botón para iniciar el proceso de petición donde podrás editar el listado de los productos.',
            'ca' => 'Fes clic en el següent botó per a iniciar el procés de petició on podràs editar el llistat dels productes.',
            'en' => 'Click on the button below to start the request process where you can edit the list of products.',
            'fr' => 'Cliquez sur le bouton ci-dessous pour lancer le processus de demande où vous pouvez modifier la liste des produits.',
            'it' => "Clicca sul pulsante qui sotto per avviare il processo di richiesta dove è possibile modificare l'elenco dei prodotti.",
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'seccion1_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pide información de estos productos',
            'ca' => "Demana informació d'aquests productes",
            'en' => 'Ask for information about these products',
            'fr' => 'Demandez des informations sur ces produits',
            'it' => 'Richiedi informazioni su questi prodotti',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'seccion1_boton',
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
            'group' => 'Favoritos',
            'key' => 'info_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos información sobre los productos que desees. Puedes editar la lista borrando los que no quieras.',
            'ca' => "Demana'ns informació sobre els productes que desitgis. Pots editar la llista esborrant els que no vulguis.",
            'en' => "Ask us for information about the products you want. You can edit the list by deleting the ones you don't want.",
            'fr' => 'Demandez-nous des informations sur les produits que vous souhaitez. Vous pouvez modifier la liste en supprimant celles que vous ne voulez pas.',
            'it' => "Richiedeteci informazioni sui prodotti che desiderate. È possibile modificare l'elenco eliminando quelli che non si desidera.",
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'info_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'productos seleccionados',
            'ca' => 'productes seleccionats',
            'en' => 'selected products',
            'fr' => 'produits sélectionnés',
            'it' => 'prodotti selezionati',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'info_seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos más información de estos productos',
            'ca' => "Demana'ns més informació d'aquests productes",
            'en' => 'Ask us for more information about these products',
            'fr' => "Demandez-nous plus d'informations sur ces produits",
            'it' => "Richiedi maggiori informazioni su questi prodotti",
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'info_formulario_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Tus datos',
            'ca' => 'Les teves dades',
            'en' => 'Your data',
            'fr' => 'Vos données',
            'it' => 'I tuoi dati',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'guardado_seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Comentarios',
            'ca' => 'Comentaris',
            'en' => 'Comments',
            'fr' => 'Commentaires',
            'it' => 'Commenti',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'guardado_comentarios',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'ENVÍO REALIZADO',
            'ca' => 'ENVIAMENT REALITZAT',
            'en' => 'SHIPMENT MADE',
            'fr' => 'EXPÉDITION FABRIQUÉE',
            'it' => 'SPEDIZIONI EFFETTUATE',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'guardado_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Gracias ',
            'ca' => 'Gràcies',
            'en' => 'Thank you',
            'fr' => 'Je vous remercie',
            'it' => 'Grazie',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'guardado_texto1_parte1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'por contactar con nosotros.',
            'ca' => 'per contactar amb nosaltres.',
            'en' => 'for contacting us.',
            'fr' => 'pour nous contacter.',
            'it' => 'per averci contattato.',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'guardado_texto1_parte2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'En breve contactaremos con usted para proporcionarle la información que nos ha pedido.',
            'ca' => 'En breu contactarem amb vostè per a proporcionar-li la informació que ens ha demanat.',
            'en' => 'We will contact you shortly to provide you with the information you have requested.',
            'fr' => 'Nous vous contacterons sous peu pour vous fournir les informations que vous avez demandées.',
            'it' => 'Vi contatteremo al più presto per fornirvi le informazioni che avete richiesto.',
        ];

        LanguageLine::create([
            'group' => 'Favoritos',
            'key' => 'guardado_texto2',
            'text' => $textos
        ]);
    }
}