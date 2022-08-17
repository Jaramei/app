<?php

namespace Application\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Application\Core\Commands\InstallCommand;
use Application\Core\Commands\PackageActivateCommand;
use Application\Core\Commands\PackageCreateCommand;
use Application\Core\Commands\PackageRemoveCommand;


class CommandsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->commands([
            PackageCreateCommand::class,
            PackageRemoveCommand::class,
            PackageActivateCommand::class,
        ]);
    }

}