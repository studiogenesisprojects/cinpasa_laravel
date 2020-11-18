<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFinishedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finisheds_materials', function (Blueprint $table) {
            $table->dropForeign('finisheds_materials_material_id_foreign');
            $table->dropColumn('material_id');
            $table->dropForeign('finisheds_materials_finished_id_foreign');
            $table->dropColumn('finished_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}