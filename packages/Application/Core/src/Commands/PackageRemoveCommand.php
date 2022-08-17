<?php

namespace Application\Core\Commands;

use Artisan;
use Application\Core\Models\Migration;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Session;

class PackageRemoveCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'package:remove {name : The module that you want to remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a package in the /packages directory.';

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * Create a new key generator command.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param Composer $composer
     * @author Sang Nguyen
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     * @author Sang Nguyen
     */
    public function handle()
    {
        if (!preg_match('/^[a-z\-]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

        $package = ucfirst(strtolower($this->argument('name')));
        $location = config('core.package_path') . '/'.$package;

        if ($this->files->isDirectory($location)) {

            if ($this->confirm('Are you sure you want to permanently delete? [yes|no]',true)) {

              //  $this->call('package:deactivate', ['name' => strtolower($package)]);

                $migrations = scan_folder($location . '/database/migrations');

                foreach ($migrations as $migration) {
                    Migration::where('migration', pathinfo($migration, 8))->delete();
                }

                $this->files->deleteDirectory($location);

                if (empty($this->files->directories(config('core.package_path')))) {
                    $this->files->deleteDirectory(config('core.package_path'));
                }

                $composer = get_file_data(base_path() . '/composer.json');
                if (!empty($composer)) {
                    unset($composer['autoload']['psr-4']['Application\\' . ucfirst($package) . '\\']);
                    save_file_data(base_path() . '/composer.json', $composer);
                }

                $this->composer->dumpAutoloads();
                $this->line('Composer autoload refreshed!');
                Artisan::call('cache:clear');
            }
        } else {
            $this->line('This package is not exists!');
        }

        Session::forget('packages');

        return true;
    }

    public function deleteFiles() {

        dd('x');

    }

}
