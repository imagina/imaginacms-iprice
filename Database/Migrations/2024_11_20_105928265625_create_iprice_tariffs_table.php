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
    Schema::create('iprice__tariffs', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('status')->default(1);
      $table->string('type')->nullable();
      $table->integer('operation ')->nullable();
      $table->integer('value ')->nullable();
      $table->text('departments')->nullable();
      $table->date('start_date')->nullable();
      $table->date('end_date')->nullable();
      $table->integer('priority')->default(0);

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
    Schema::dropIfExists('iprice__tariffs');
  }
};
