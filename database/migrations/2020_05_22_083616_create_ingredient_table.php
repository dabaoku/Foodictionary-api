<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient', function (Blueprint $table) {
            $table->bigIncrements('ingredient_id');
            $table->string('ingredient_name');
            $table->string('ingredient_alias_1')->nullable();
            $table->string('ingredient_alias_2')->nullable();
            $table->string('ingredient_alias_3')->nullable();
            $table->string('ingredient_knowledge')->nullable();
            $table->string('ingredient_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient');
    }
}
