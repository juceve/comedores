<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranjasTable extends Migration
{
    
    public function up()
    {
        Schema::create('franjas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->string('horainicio');
            $table->string('horafinal');
            $table->decimal('precio',10,2)->nullable();
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('franjas');
    }
}
