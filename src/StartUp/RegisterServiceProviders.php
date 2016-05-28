<?php

namespace IdeaSeven\Core\StartUp;
use App;

/**
 * Register your dependencies Service Providers here
 * Class RegisterServiceProviders
 * @package IdeaSeven\Core\StartUp
 */
class RegisterServiceProviders
{
    /**
     *
     */
    public function handle()
    {
        App::register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        App::register(\JeroenG\Packager\PackagerServiceProvider::class);
        App::register(\Dingo\Api\Provider\LaravelServiceProvider::class);
        App::register(\Barryvdh\Debugbar\ServiceProvider::class);
        App::register(\Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider::class);
        App::register(\Bican\Roles\RolesServiceProvider::class);
        App::register(\Themsaid\Multilingual\MultilingualServiceProvider::class);
        App::register(\Arrilot\Widgets\ServiceProvider::class);
        App::register(\Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider::class);
        App::register(\Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class);
        App::register(\Barryvdh\TranslationManager\ManagerServiceProvider::class);
    }
}