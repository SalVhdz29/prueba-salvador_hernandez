<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('correo', 150);
            $table->string('telefono',8);
            $table->string('direccion',200);
            $table->integer('id_departamento');
            $table->integer('id_municipio');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
