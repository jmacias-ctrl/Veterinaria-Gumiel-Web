<?php

namespace App\Providers;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Services\HorarioFuncionarioService;
use Illuminate\Support\ServiceProvider;

class HorarioFuncionarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HorarioFuncionarioServiceInterface::class, HorarioFuncionarioService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
