<?php namespace Application\Core\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Config;
Use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Helper\SymfonyQuestionHelper;
use Symfony\Component\Console\Question\Question;
use Exception;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Application\Core\Repositories\Users\Interfaces\UserInterface;

class InstallCommand extends Command
{

    protected $signature = 'platform:install  {name : The platform install module}';
    protected $description = 'Install platform DbCore';

    protected $composer;
    protected $process;
    protected $files;
    protected $username;
    protected $password;
    protected $database;
    protected $user;


    public function __construct(Composer $composer,Filesystem $files, UserInterface $user)
    {

        parent::__construct();
        $this->composer = $composer;
        $this->files = $files;
        $this->user = $user;

    }

    public function handle() {

      //  $this->envName();
      //  $this->envUrl();

     //  $this->requires();

        $this->database();
      //  $this->seeds();
        $this->setCacheKeyPrefix($this->database);

      //  $this->call('make:auth');
      //  $this->migrations();

     //  $this->call('migrate');
         $this->call('storage:link');
      // $this->copyFiles();



     //  $this->createUser();
       $this->call('vendor:publish',['--provider'=>'Application\Core\Providers\CoreServiceProvider']);


       $this->call('cache:clear');
       $this->composer->dumpAutoloads();
       $this->composer->dumpOptimized();


    }

    private function envName() {

        $contents = $this->getKeyFile();
        $contents = preg_replace('/(' . preg_quote('APP_NAME=') . ')(.*)/', 'APP_NAME=' . $this->argument('name'), $contents);
        $this->files->put('.env', $contents);

    }

    private function envUrl() {

        $nameDomain = $this->ask('Please get your domain address');

        $contents = $this->getKeyFile();
        $contents = preg_replace('/(' . preg_quote('APP_URL=') . ')(.*)/', 'APP_URL=' . $nameDomain, $contents);
        $this->files->put('.env', $contents);

    }

    private function requires() {

        $composer = get_file_data(base_path() . '/composer.json');
        $composer['require']['laravelcollective/html'] = "^5.3.0";
        $composer['require']['intervention/image'] = "^2.3";
        $composer['require']['devfactory/minify'] = "1.0.*";
        $composer['require']['jackiedo/log-reader'] ="2.*";
        $composer['require']['cviebrock/eloquent-sluggable'] = "^4.5";
        save_file_data(base_path() . '/composer.json', $composer);

        $process = new Process('composer update');
        $process->run();

        $process->wait();


        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


        $this->line('----------ADD PROVIDERS AND ALIANS--------');
        $this->line('Provider: Devfactory\Minify\MinifyServiceProvider:class');
        $this->line('Alians: Minify => Devfactory\Minify\Facades\MinifyFacade:class');
        if($this->confirm('Did you add provider/alians to devfactory/minifty in config/app?','yes')) {

            $publish = new process('php artisan vendor:publish --provider="Devfactory\Minify\MinifyServiceProvider"');
            $publish->run();
            $publish->wait();

        }

        $this->line('----------ADD PROVIDERS AND ALIANS--------');
        $this->line('Provider: Jackiedo\LogReader\LogReaderServiceProvider::class');
        $this->line('Alians: LogReader => Jackiedo\LogReader\Facades\LogReader::class');
        if($this->confirm('Did you add provider/alians to jackiedo/LogReader in config/app?','yes')) {

            $publish = new process('php artisan vendor:publish --provider="Jackiedo\LogReader\LogReaderServiceProvider" --tag="config"');
            $publish->run();
            $publish->wait();

        }

    }

    private function setCacheKeyPrefix($prefix)
    {
        $path = 'config/cache.php';
        list($path, $contents) = [$path, $this->files->get($path)];

        $contents = str_replace($this->laravel['config']['cache.prefix'], $prefix, $contents);

        $this->files->put($path, $contents);

        $this->laravel['config']['cache.prefix'] = $prefix;

        $this->info('Application cache key prefix ' . $prefix . ' set successfully.');
    }

    private function database() {

        $this->info('Setting up database (please make sure you created database for this site)...');

        $this->database = env('DB_DATABASE');
        $this->username = env('DB_USERNAME');
        $this->password = env('DB_PASSWORD');

        while (!check_database_connection()) {
            // Ask for database name
            $this->database = $this->ask('Enter a database name', $this->guessDatabaseName());

            $this->username = $this->ask('What is your MySQL username?', 'root');

            $question = new Question('What is your MySQL password?', '<none>');
            $question->setHidden(true)->setHiddenFallback(true);
            $this->password = (new SymfonyQuestionHelper())->ask($this->input, $this->output, $question);
            if ($this->password === '<none>') {
                $this->password = '';
            }

            // Update DB credentials in .env file.
            $contents = $this->getKeyFile();
            $contents = preg_replace('/(' . preg_quote('DB_DATABASE=') . ')(.*)/', 'DB_DATABASE=' . $this->database, $contents);
            $contents = preg_replace('/(' . preg_quote('DB_USERNAME=') . ')(.*)/', 'DB_USERNAME=' . $this->username, $contents);
            $contents = preg_replace('/(' . preg_quote('DB_PASSWORD=') . ')(.*)/', 'DB_PASSWORD=' . $this->password, $contents);

            if (!$contents) {
                throw new Exception('Error while writing credentials to .env file.');
            }

            // Write to .env
            $this->files->put('.env', $contents);

            // Set DB username and password in config
            $this->laravel['config']['database.connections.mysql.username'] = $this->username;
            $this->laravel['config']['database.connections.mysql.password'] = $this->password;

            // Clear DB name in config
            unset($this->laravel['config']['database.connections.mysql.database']);

            if (!check_database_connection()) {
                $this->error('Can not connect to database, please try again!');
            } else {
                $this->info('Connect to database successfully!');
            }
        }

    }

    private function seeds() {

        $this->info('Setting up database seed ...');



        foreach ($this->files->allFiles(base_path().'/packages/Application/Core/database/seeds') as $file) {

            $this->files->copy($file, base_path() . '/database/seeds/'.basename($file));
            $this->call('dump-autoload');
            $this->call('db:seed',['--class'=>basename($file,".php")]);


        }

        $this->info('Platform seeds have been done!');

    }


    private function copyFiles() {

        $this->files->copyDirectory(base_path().'/packages/Application/Core/Install/Auth/Controllers/', base_path() . '/App/Http/Controllers/Auth');

        $this->files->copy(base_path().'/packages/Application/Core/Install/Auth/Models/User.php',base_path().'/App/User.php');

        $this->info('The Files have been copied.');

    }


    private function migrations() {

        foreach ($this->files->directories(base_path().'/packages/Application/Core/database/migrations') as $folder) {

            $this->files->copyDirectory($folder, base_path() . '/database/migrations');

        }


        $this->info('Platform migrations have been copied to database/migrations.');

    }

    private function createUser() {



       $this->line('Creating a User...');


       $user = $this->user->getModel();
       $user->name = $this->ask('Enter your username');
       $user->email = $this->ask('Enter your email address');
       $user->password = bcrypt($this->secret('Enter a password'));
       $this->user->save($user);

       $this->info('The user '.$user->name.' was created!');




    }

    private function guessDatabaseName()
    {
        try {
            $segments = array_reverse(explode(DIRECTORY_SEPARATOR, app_path()));
            $name = explode('.', $segments[1])[0];

            return str_slug($name);
        } catch (Exception $e) {
            return '';
        }
    }


    private function getKeyFile()
    {
        return $this->files->exists('.env') ? $this->files->get('.env') : $this->files->get('.env.example');
    }

}