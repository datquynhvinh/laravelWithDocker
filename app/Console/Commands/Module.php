<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (File::exists(base_path('modules/' . $name))) {
            $this->error('Module already exists!');

            return false;
        }

        File::makeDirectory(base_path('modules/' . $name), 0755, true, true);

        // Setting configuration
        $configFolder = base_path('modules/' . $name . '/configs');
        if (!File::exists($configFolder)) {
            File::makeDirectory($configFolder, 0755, true, true);
        }
        // Setting helpers
        $helpersFolder = base_path('modules/' . $name . '/helpers');
        if (!File::exists($helpersFolder)) {
            File::makeDirectory($helpersFolder, 0755, true, true);
        }
        // Setting migrations
        $migrationsFolder = base_path('modules/' . $name . '/migrations');
        if (!File::exists($migrationsFolder)) {
            File::makeDirectory($migrationsFolder, 0755, true, true);
        }
        // Setting resources
        $resourcesFolder = base_path('modules/' . $name . '/resources');
        if (!File::exists($resourcesFolder)) {
            File::makeDirectory($resourcesFolder, 0755, true, true);
        }
        // Setting routes
        $routesFolder = base_path('modules/' . $name . '/routes');
        if (!File::exists($routesFolder)) {
            File::makeDirectory($routesFolder, 0755, true, true);
        }
        // Setting src
        $srcFolder = base_path('modules/' . $name . '/src');
        if (!File::exists($srcFolder)) {
            File::makeDirectory($srcFolder, 0755, true, true);
        }

        $this->info('Module created successfully!');
    }
}
