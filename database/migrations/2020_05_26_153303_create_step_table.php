<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('step');
            $table->string('step_prescription');
            $table->unsignedBigInteger('step_time')->nullable();
            $table->timestamps();

            // 建立 recipe_id 的 foreign key
            $table->foreign('recipe_id')->references('id')->on('recipes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('step');
    }
}
