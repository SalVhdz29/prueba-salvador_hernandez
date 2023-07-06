<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empleado = new Empleado();
        $empleado->nombre="Salvador Enrique";
        $empleado->apellido="Hernandez Chavez";
        $empleado->correo="salvadorehchavez@gmail.com";
        $empleado->direccion="Urb Coruña 1 psj3";
        $empleado->telefono="71098697";
        $empleado->id_departamento=1;
        $empleado->id_municipio=3;
        $empleado->save();

        $empleado = new Empleado();
        $empleado->nombre="Ricardo Amilcar";
        $empleado->apellido="Hernandez Chavez";
        $empleado->correo="ricardoehchavez@gmail.com";
        $empleado->direccion="Urb Coruña 1 psj3";
        $empleado->telefono="77016580";
        $empleado->id_departamento=7;
        $empleado->id_municipio=9;
        $empleado->save();

        $empleado = new Empleado();
        $empleado->nombre="Nancy";
        $empleado->apellido="Chavez";
        $empleado->correo="nanliz@gmail.com";
        $empleado->direccion="Urb Coruña 1 psj3";
        $empleado->telefono="71809310";
        $empleado->id_departamento=12;
        $empleado->id_municipio=14;
        $empleado->save();
    }
}
