<?php

namespace EllipseSynergie\LocaleToCsv;

use Illuminate\Support\ServiceProvider;
use EllipseSynergie\LocaleToCsv\Commands\ExportCommand;
use EllipseSynergie\LocaleToCsv\Commands\ImportCommand;

class ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ExportCommand::class,
                ImportCommand::class,
            ]);
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
    }
}