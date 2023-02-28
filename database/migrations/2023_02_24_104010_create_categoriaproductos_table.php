<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriaproductos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoriaproductos');
    }
}
