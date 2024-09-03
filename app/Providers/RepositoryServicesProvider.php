<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Http\Interfaces\AuthInterface',
            'App\Http\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\DepartmentInterface',
            'App\Http\Repositories\DepartmentRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\EmployeeInterface',
            'App\Http\Repositories\EmployeeRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\TaskInterface',
            'App\Http\Repositories\TaskRepository'
        );

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
