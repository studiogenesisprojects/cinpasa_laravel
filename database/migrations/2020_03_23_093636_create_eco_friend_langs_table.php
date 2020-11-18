<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoFriendLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eco_friend_langs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('eco_friend_id');
            $table->foreign('eco_friend_id')->references('id')->on('eco_friends');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id')->references('id')->on('language');

            $table->text("name")->nullable();

            $table->timestamps();
        });

        if (Schema::hasColumn('eco_friends', 'name')) {
            Schema::table('eco_friends', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eco_friend_langs');
    }
}
