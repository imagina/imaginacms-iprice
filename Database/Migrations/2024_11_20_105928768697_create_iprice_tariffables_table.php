<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('iprice__tariffables', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('entity_type')->nullable();
      $table->integer('entity_id')->nullable();
      $table->integer('tariff_id')->unsigned()->nullable();
      $table->integer('value')->nullable();
      $table->integer('price_id')->unsigned()->nullable();

      $table->foreign('tariff_id')->references('id')->on('iprice__tariffs')->onDelete('cascade');
      $table->foreign('price_id')->references('id')->on('iprice__prices')->onDelete('cascade');
      // Audit fields
      $table->timestamps();
      $table->auditStamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('iprice__tariffables', function (Blueprint $table) {
      $table->dropForeign(['tariff_id']);
      $table->dropForeign(['price_id']);
    });
    Schema::dropIfExists('iprice__tariffables');
  }
};
