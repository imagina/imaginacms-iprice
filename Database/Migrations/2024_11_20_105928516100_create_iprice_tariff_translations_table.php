<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpriceTariffTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('iprice__tariff_translations', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('title ')->nullable();

      $table->integer('tariff_id')->unsigned();
      $table->string('locale')->index();
      $table->unique(['tariff_id', 'locale']);
      $table->foreign('tariff_id')->references('id')->on('iprice__tariffs')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('iprice__tariff_translations', function (Blueprint $table) {
      $table->dropForeign(['tariff_id']);
    });
    Schema::dropIfExists('iprice__tariff_translations');
  }
}
