<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservalunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservalunches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained();
            $table->date('fecha');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->boolean('estado')->default(0);
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
        Schema::dropIfExists('reservalunches');
    }
}
