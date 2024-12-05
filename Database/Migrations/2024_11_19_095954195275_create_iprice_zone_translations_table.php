<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpriceZoneTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iprice__zone_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('title');
            $table->string('description')->nullable();

            $table->integer('zone_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['zone_id', 'locale']);
            $table->foreign('zone_id')->references('id')->on('iprice__zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iprice__zone_translations', function (Blueprint $table) {
            $table->dropForeign(['zone_id']);
        });
        Schema::dropIfExists('iprice__zone_translations');
    }
}
