<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpricePriceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iprice__price_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('price_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['price_id', 'locale']);
            $table->foreign('price_id')->references('id')->on('iprice__prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iprice__price_translations', function (Blueprint $table) {
            $table->dropForeign(['price_id']);
        });
        Schema::dropIfExists('iprice__price_translations');
    }
}
