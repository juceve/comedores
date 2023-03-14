<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigturnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configturnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turno_id')->constrained();
            $table->foreignId('franja_id')->constrained();
            $table->boolean('presencial');
            $table->boolean('generareserva')->default(0);     
            $table->unsignedBigInteger('reservafranja')->nullable();       
            $table->foreign('reservafranja')->references('id')->on('franjas');
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
        Schema::dropIfExists('configturnos');
    }
}
