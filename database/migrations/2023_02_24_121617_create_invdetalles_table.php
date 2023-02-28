<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvdetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invdetalles', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['ENTRADA','SALIDA']);
            $table->foreignId('inventario_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            $table->integer('cantidad');
            $table->decimal('subtotal',2)->nullable();
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
        Schema::dropIfExists('invdetalles');
    }
}
