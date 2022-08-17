<?php

namespace Application\Core\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Schema;


class PackageActivateCommand extends Command
{

    protected $files;
    protected $composer;
    protected $package;
    protected $signature = 'package:activate  {name : The module that you want to activate}';
    protected $description = 'Activate a package in the /packages directory';


    public function __construct(Filesystem $files, Composer $composer)
    {

        parent::__construct();

        $this->composer = $composer;
        $this->files = $files;

    }

    public function handle() {

        $this->package =  ucfirst($this->argument('name'));

        $this->checkLocation();

        $this->installMigrations();

        $this->registerComposer();

        $this->call('optimize');

        return true;


    }

    private function checkLocation() {

        if(!$this->files->isDirectory(config('core.package_path').'/'.$this->package)) {

            $this->error('A package named ['.$this->package.'] already exists.');
            return false;

        }

    }

    private function installMigrations() {

        if(!$this->files->isDirectory(base_path('/database/migrations/'.ucfirst($this->package)))) {

            $this->files->makeDirectory(base_path('/database/migrations/'.ucfirst($this->package)));

        }

        foreach ($this->files->allFiles(config('core.package_path').'/'.ucfirst($this->package).'/database/migrations') as $file) {

            $this->files->copy($file, base_path() . '/database/migrations/' . ucfirst($this->package).'/' . basename($file));

        }

        if (!Schema::hasTable(lcfirst($this->package))) {

            Artisan::call('migrate',
                [
                    '--database' => 'mysql',
                    '--path'     => '/database/migrations/'.ucfirst($this->package),

                ]);



        }

        $this->line('Migrations install completed!');

    }

    private function registerComposer() {

        $package = get_file_data(config('core.package_path').'/'.ucfirst($this->package).'/package.json');
        if (!empty($package)) {

            $composer = get_file_data(base_path() . '/composer.json');
            if (!empty($composer)) {
                $composer['autoload']['psr-4']['Application\\'.ucfirst($this->package).'\\'] = 'packages/Application/' . ucfirst($this->package) . '/src';
                save_file_data(base_path() . '/composer.json', $composer);
            }

            $this->composer->dumpAutoloads();
            $this->line('Composer autoload refreshed!');
            Artisan::call('cache:clear');

        }


    }

}