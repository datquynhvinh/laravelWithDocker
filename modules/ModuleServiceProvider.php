<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        foreach ($directories as $moduleName) {
            // Define configuration
            $configPath = __DIR__ . '/' . $moduleName . '/configs';
            if (File::exists($configPath)) {
                $configFiles = array_map('basename', File::allFiles($configPath));
                foreach ($configFiles as $configFile) {
                    $this->mergeConfigFrom(
                        $configPath . '/' . $configFile, strtolower($moduleName)
                   );
                }
            }
        }

        // Define middleware
        $middlewares = [
            'demo' => \Modules\Module1\src\Http\Middlewares\DemoMiddleware::class,
        ];
        if (!empty($middlewares)) {
            foreach ($middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }

        // Defineo commands
        $this->commands([
            \Modules\Module1\src\Commands\DemoCommand::class,
        ]);
    }

    /**
     * Register modules according to the directory structure
     *
     * @return void
     */
    public function boot()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        foreach ($directories as $moduleName) {
            $this->registerModule($moduleName);
        }
    }

    /**
     * Registration declaration for each module.
     *
     * @return void
     */
    private function registerModule($moduleName) {
        $modulePath = __DIR__ . "/$moduleName/";

        // Define route
        if (File::exists($modulePath . "routes/routes.php")) {
            $this->loadRoutesFrom($modulePath . "routes/routes.php");
        }

        // Define migration
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        // Define languages
        if (File::exists($modulePath . "resources/lang")) {
            // Multi-language by php file
            $this->loadTranslationsFrom($modulePath . "resources/lang", $moduleName);
            // Multi-language by json file
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
        }

        // Define views
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", $moduleName);
        }

        // Define helpers
        if (File::exists($modulePath . "helpers")) {
            // Get all files
            $helperDir = File::allFiles($modulePath . "helpers");
            foreach ($helperDir as $value) {
                $file = $value->getPathName();
                require $file;
            }
        }
    }
}
