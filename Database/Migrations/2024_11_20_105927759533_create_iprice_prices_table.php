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
    Schema::create('iprice__prices', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->double('price', 30, 2)->default(0);
      $table->string('entity_type')->nullable();
      $table->integer('entity_id')->nullable();
      $table->integer('zone_id')->unsigned();
      $table->foreign('zone_id')->references('id')->on('iprice__zones')->onDelete('cascade');

      $table->unique(['entity_type', 'entity_id', 'zone_id'], 'unique_entity_type_id_zone');
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
    Schema::dropIfExists('iprice__prices');
  }
};
