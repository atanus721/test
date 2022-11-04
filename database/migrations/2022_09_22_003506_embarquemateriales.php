<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embarquemateriales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_tienda")->unsigned();
            $table->dateTime("fecha");
            $table->string("archivo");
            $table->timestamps();
            
            $table->foreign("id_tienda")->references("id")->on("tiendas")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embarquemateriales');
    }
};
