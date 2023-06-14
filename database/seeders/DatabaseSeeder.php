<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(class:tiposerviciosSeeder::class);
        $this->call(class: UserSeeder::class);
        $this->call(class: MarcaInsumosSeeder::class);
        $this->call(class:EspecieSeeder::class);
        $this->call(class:tipoproductos_ventasSeeder::class);
        $this->call(class: ProductosVentaSeeder::class);
        $this->call(class:TipoinsumosSeeder::class);
        $this->call(class:InsumosmedicosSeeder::class);
        $this->call(class:HorariosFuncionariosTableSeeder::class);
        $this->call(class:ServicioSeeder::class);
        $this->call(class:marcamedicamentos_vacunasSeeder::class);
        $this->call(class:tipoproductos_ventasSeeder::class);
        $this->call(class:tipomedicamentos_vacunasSeeder::class);
        $this->call(class:medicamentos_vacunasSeeder::class);
        $this->call(class:whereYouCanFindSeeder::class);
        $this->call(class:landingpageSeeder::class);
        $this->call(class:AboutUsSeeder::class);
        $this->call(class:LandingPageGaleriaSeeder::class);
        $this->call(class:LandingPageInicioSeeder::class);
        $this->call(class:TipoConsulta_TamaniosSeeder::class);
        $this->call(class:DisponibilidadVeterinariaSeeder::class);
        $this->call(class:ReservarCitasSeeder::class);
    }
}
