<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpriceTariffableTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iprice__tariffable_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('tariffable_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['tariffable_id', 'locale']);
            $table->foreign('tariffable_id')->references('id')->on('iprice__tariffables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iprice__tariffable_translations', function (Blueprint $table) {
            $table->dropForeign(['tariffable_id']);
        });
        Schema::dropIfExists('iprice__tariffable_translations');
    }
}
