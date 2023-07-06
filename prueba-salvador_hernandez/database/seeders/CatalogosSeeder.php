<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use Illuminate\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // San Salvador
        $catalogop = new Catalogo();
        $catalogop->valor="San Salvador";
        $catalogop->grupo="DEPARTAMENTOS";
        $catalogop->save();

        $catalogo = new Catalogo();
        $catalogo->valor="San Salvador";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Soyapango";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Santa Tecla";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Mejicanos";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Apopa";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        //La Libertad
        $catalogop = new Catalogo();
        $catalogop->valor="La Libertad";
        $catalogop->grupo="DEPARTAMENTOS";
        $catalogop->save();

        $catalogo = new Catalogo();
        $catalogo->valor="La Libertad";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Antiguo Cuscatlán";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Zaragoza";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Colón";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        // Santa Ana
        $catalogop = new Catalogo();
        $catalogop->valor="Santa Ana";
        $catalogop->grupo="DEPARTAMENTOS";
        $catalogop->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Santa Ana";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Metapán";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Chalchuapa";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

        $catalogo = new Catalogo();
        $catalogo->valor="Coatepeque";
        $catalogo->grupo="MUNICIPIOS";
        $catalogo->id_padre=$catalogop->id;
        $catalogo->save();

    }
}
