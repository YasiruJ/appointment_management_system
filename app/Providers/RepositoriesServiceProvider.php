<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Contracts\PatientInterface',
            'App\Repositories\PatientRepository'
        );

        $this->app->bind(
            'App\Contracts\AppointmentInterface',
            'App\Repositories\AppointmentRepository'
        );

        $this->app->bind(
            'App\Contracts\InvoiceInterface',
            'App\Repositories\InvoiceRepository'
        );

        $this->app->bind(
            'App\Contracts\ReceiptInterface',
            'App\Repositories\ReceiptRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
