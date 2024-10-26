<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Permitir null en user_id
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('nombre_propietario'); // Campo para el nombre del propietario
            $table->string('direccion_propietario'); // Campo para la dirección del propietario
            $table->string('telefono_propietario'); // Campo para el teléfono del propietario
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente');
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}

