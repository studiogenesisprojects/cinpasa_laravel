<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageTableSeeder::class);
        // $this->call(ProductAuxSeed::class);
        $this->call(SectionTableSeeder::class);
        // $this->call(PetitionsTableSeeder::class);
        // $this->call(ApplicationSeeder::class);
        $this->call(UserBack::class);
        // $this->call(NoticiaSeed::class);
        $this->call(CarrouselSeed::class);
        // $this->call(FinishesSeeder::class);
        // $this->call(ProductSeed::class);
        $this->call(CustomersSeeder::class);

        // // translations
        $this->call(TraductionsCompany::class);
        $this->call(TraductionsContact::class);
        $this->call(TraductionsApplications::class);
        $this->call(TraductionsEndings::class);
        $this->call(TraductionsMaterials::class);
        $this->call(TraductionsColors::class);
        $this->call(TraductionsNews::class);
        $this->call(TraductionsCommon::class);
        $this->call(TraductionsProducts::class);
        $this->call(TraductionsFavorites::class);
        $this->call(TraductionsJobsOffers::class);
        $this->call(TraductionsPoliticPages::class);
        $this->call(TraductionsFooter::class);
        $this->call(TranslationsBlock100::class);
        $this->call(TranslationsHomepage::class);
        $this->call(TranslationsHeader::class);
        $this->call(TranslationsSearcher::class);
        $this->call(TranslationsCoockieConsent::class);
    }
}