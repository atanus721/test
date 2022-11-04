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
        Schema::create('traspasos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_tienda_destino")->unsigned();
            $table->bigInteger("id_tienda_origen")->unsigned();
            $table->date("fecha");
            $table->integer("folio")->unsigned();
            $table->string("archivo");
            $table->timestamps();
            
            $table->foreign("id_tienda_destino")->references("id")->on("tiendas")->cascadeOnDelete();
            $table->foreign("id_tienda_origen")->references("id")->on("tiendas")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traspasos');
    }
};
