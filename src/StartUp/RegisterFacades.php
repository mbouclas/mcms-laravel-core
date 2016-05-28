<?php

namespace IdeaSeven\Core\StartUp;

use IdeaSeven\Core\Facades\MenuConnectorFacade;
use IdeaSeven\Core\Services\Installer\Install;
use IdeaSeven\Core\Services\Menu\ConnectorRegistry;
use IdeaSeven\Core\Widgets\WidgetFacade;
use IdeaSeven\Core\Widgets\Widget;
use App;
use Illuminate\Support\ServiceProvider;

/**
 * Register your Facades/aliases here
 * Class RegisterFacades
 * @package IdeaSeven\Core\StartUp
 */
class RegisterFacades
{
    /**
     * @param ServiceProvider $serviceProvider
     */
    public function handle(ServiceProvider $serviceProvider)
    {
        //Instantiate the Installer facade
        App::bind('Installer', function(){
            return new Install();
        });

        //Instantiate the Widget facade
        App::bind('Widget', function(){
            return new Widget();
        });

        App::bind('MenuConnector', function(){
            return new ConnectorRegistry();
        });
        
        $facades = \Illuminate\Foundation\AliasLoader::getInstance();
        $facades->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        $facades->alias('Installer', \IdeaSeven\Core\Facades\InstallerFacade::class);
        $facades->alias('Widget', WidgetFacade::class);
        $facades->alias('MenuConnector', MenuConnectorFacade::class);
        $facades->alias('LaravelLocalization', \Mcamara\LaravelLocalization\Facades\LaravelLocalization::class);
    }
}