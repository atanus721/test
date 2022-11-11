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
        Schema::create('preciostiendas', function (Blueprint $table) {
            $table->id();
            $table->integer("id_sap",FALSE,TRUE);
            $table->string("sku");
            $table->decimal("precioa");
            $table->decimal("preciob");
            $table->decimal("precioc");
            $table->decimal("preciod");
            $table->timestamps();
            
            $table->foreign("id_sap")->references("id_sap")->on("tiendas")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preciostiendas');
    }
};
