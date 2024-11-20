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
      $table->string('entity_type')->nullable();

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
