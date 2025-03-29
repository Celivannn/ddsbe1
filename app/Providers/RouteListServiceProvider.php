<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Command;
use Laravel\Lumen\Routing\Router;

class RouteListServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('command.route:list', function () {
            return new class extends Command {
                protected $signature = 'route:list';
                protected $description = 'List all registered routes';

                public function handle()
                {
                    $router = app(Router::class);
                    $routes = $router->getRoutes();

                    $this->info(str_pad('Method', 10) . str_pad('URI', 50));
                    $this->info(str_repeat('-', 60));

                    foreach ($routes as $route) {
                        $method = implode('|', $route['method']);
                        $uri = $route['uri'];

                        $this->line(str_pad($method, 10) . str_pad($uri, 50));
                    }
                }
            };
        });

        $this->commands(['command.route:list']);
    }
}
