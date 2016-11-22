<?php

namespace EllipseSynergie\LocaleToYaml;

use Illuminate\Support\ServiceProvider;
use EllipseSynergie\LocaleToYaml\Commands\ExportCommand;
use EllipseSynergie\LocaleToYaml\Commands\ImportCommand;

class LocaleToYamlServiceProvider extends ServiceProvider
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