<?php  namespace Application\Core\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Composer;
Use Carbon\Carbon;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\MountManager;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Schema;

class PackageCreateCommand extends Command
{

    protected $files;
    protected $package;
    protected $location;
    protected $signature = 'package:create {name : The module that you want to create} {--force : Overwrite any existing files.}';
    protected $description = 'Create a package in the /packages directory.';
    protected $composer;

    public function __construct(Filesystem $files, Composer $composer)
    {

        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;

    }


    public function handle()
    {

        $this->validateNamePackage();

        $this->package =  ucfirst($this->argument('name'));
        $this->location = config('core.package_path') . '/'.$this->package;

        $this->checkExistFolder();

        $this->publishStubs();

        $this->renameModelsAndRepositories($this->location);

        $this->searchAndReplaceInFiles();

        $this->installMigrations();

        $this->line('------------------');
        $this->line('<info>The package</info> <comment>' . studly_case($this->package) . '</comment> <info>was created in</info> <comment>' .$this->location. '</comment><info>, customize it!</info>');
        $this->line('------------------');

        $this->registerComposer();


        Session::forget('packages');
        $this->call('dump-autoload');
        $this->composer->dumpAutoloads();


        return true;

    }

    private function validateNamePackage()
    {
        if (!preg_match('/^[a-z\-]+$/i', $this->argument('name'))) {
            $this->error('Only alphabetic characters are allowed.');
            return false;
        }

    }

    private function checkExistFolder() {

        if ($this->files->isDirectory($this->location)) {
            $this->error('A package named ['.$this->package.'] already exists.');
            return false;
        }


    }

    private function publishStubs() {

        if ($this->files->isDirectory(config('core.stubs_path'))) {

             $this->publishDirectory(config('core.stubs_path'),$this->location);

        } else {

            $this->error("Can't locate path: ".config('core.stubs_path').".");

        }

    }

    protected function publishDirectory($from,$to) {

        $manager = new MountManager([
            'from'=> new Flysystem(new LocalAdapter($from)),
            'to'=> new Flysystem(new LocalAdapter($to))

        ]);

        foreach($manager->listContents('from://',true) as $file) {

            if($file['type'] == 'file' && (!$manager->has('to://'.$file['path']) || $this->option('force')))
            {
                $manager->put('to://'.$file['path'],$manager->read('from://'.$file['path']));
            }
        }
    }

    public function searchAndReplaceInFiles()
    {

        $manager = new MountManager([
            'directory' => new Flysystem(new LocalAdapter($this->location)),
        ]);

        foreach ($manager->listContents('directory://', true) as $file) {
            if ($file['type'] === 'file') {
                $content = str_replace(['{package}', '{Package}', '{PACKAGE}', '{migrate_date}'], [strtolower($this->package), studly_case($this->package), strtoupper($this->package), Carbon::now()->format('Y_m_d_His')], $manager->read('directory://' . $file['path']));
                $manager->put('directory://' . $file['path'], $content);
            }
        }
    }

    public function renameModelsAndRepositories($location) {

        $paths = scan_folder($location);
        if (empty($paths)) {
            return false;
        }

        foreach ($paths as $path) {
            $path = $location .'/'. $path;
            $newPath = $this->transformFilename($path);
            rename($path, $newPath);
            $this->renameModelsAndRepositories($newPath);
        }
        return true;

    }

    public function transformFilename($path)
    {
        return str_replace(
            ['{package}', '{Package}', '.stub', '{migrate_date}'],
            [strtolower($this->package), studly_case($this->package), '.php', Carbon::now()->format('Y_m_d_His')],
            $path
        );
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

        $plugin = get_file_data($this->location . '/package.json');
        if (!empty($plugin)) {
            $composer = get_file_data(base_path() . '/composer.json');
            if (!empty($composer)) {
                $composer['autoload']['psr-4']['Application\\'.ucfirst($this->package).'\\'] = 'packages/Application/' . ucfirst($this->package) . '/src';
                save_file_data(base_path() . '/composer.json', $composer);
            }


            $this->line('Composer autoload refreshed!');
            $this->call('cache:clear');
        }

    }


}