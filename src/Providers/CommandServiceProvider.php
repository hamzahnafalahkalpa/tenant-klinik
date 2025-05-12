<?php

namespace Klinik\TenantKlinik\Providers;

use Illuminate\Support\ServiceProvider;
use Klinik\TenantKlinik\Commands;

class CommandServiceProvider extends ServiceProvider
{
    protected $__commands = [
        Commands\MigrateCommand::class,
        Commands\SeedCommand::class,
        Commands\InstallMakeCommand::class
    ];

    /**
     * Register the command.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(config('tenant-klinik.commands', $this->__commands));
    }

    public function provides()
    {
        return $this->__commands;
    }
}
