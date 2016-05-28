<?php

namespace IdeaSeven\Core;

use App;
use IdeaSeven\Core\StartUp\RegisterDirectives;
use IdeaSeven\Core\StartUp\RegisterEvents;
use IdeaSeven\Core\StartUp\RegisterFacades;
use IdeaSeven\Core\StartUp\RegisterMiddleware;
use IdeaSeven\Core\StartUp\RegisterRepositories;
use IdeaSeven\Core\StartUp\RegisterServiceProviders;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Routing\Router;


/**
 * Service Provider for the Core module
 * Class CoreServiceProvider
 * @package IdeaSeven\Core
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        \IdeaSeven\Core\Console\Commands\CreateUserRole::class,
        \IdeaSeven\Core\Console\Commands\SeedUserRole::class,
        \IdeaSeven\Core\Console\Commands\CreateUser::class,
        \IdeaSeven\Core\Console\Commands\CreateUserPermissions::class,
        \IdeaSeven\Core\Console\Commands\Install::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Router $router, DispatcherContract $events)
    {
        $this->publishes([
            __DIR__.'/../config/core.php' => config_path('core.php'),
            __DIR__.'/../config/locales.php' => config_path('locales.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds')
        ], 'seeds');

        /**
         * Register custom Blade directives
         */
        (new RegisterDirectives())->handle();
        /*
         * Register dependencies
        */
        (new RegisterServiceProviders())->handle();

        /*
         * Register middleware
         */
        (new RegisterMiddleware())->handle($this,$router);

        /**
         * Register Events
         */
        parent::boot($events);
        (new RegisterEvents())->handle($this, $events);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register Commands
         */
        $this->commands($this->commands);

        /**
         * Register Facades
         */
        (new RegisterFacades())->handle($this);

        /**
         * Register Repositories
         */
        (new RegisterRepositories())->handle($this);
    }
}
