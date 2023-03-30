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
        $modules = $this->getModules();
        foreach ($modules as $module) {
            // Define configuration
            $configPath = __DIR__ . '/' . $module . '/configs';
            if (File::exists($configPath)) {
                $configFiles = array_map('basename', File::allFiles($configPath));
                foreach ($configFiles as $configFile) {
                    $this->mergeConfigFrom(
                        $configPath . '/' . $configFile, strtolower($module)
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

        // Define commands
        $this->commands([
            \Modules\Module1\src\Commands\DemoCommand::class,
        ]);

        $this->app->singleton(
            \Modules\User\src\Repositories\UserRepository::class
        );
    }

    /**
     * Register modules according to the directory structure
     *
     * @return
     */
    public function boot()
    {
        $modules = $this->getModules();
        foreach ($modules as $module) {
            $this->registerModule($module);
        }
    }

    /**
     *
     * @return array
     */
    private function getModules() {
        return array_map('basename', File::directories(__DIR__));
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
            $this->loadTranslationsFrom($modulePath . "resources/lang", strtolower($moduleName));
            // Multi-language by json file
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
        }

        // Define views
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", strtolower($moduleName));
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
