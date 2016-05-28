<?php

namespace IdeaSeven\Core\StartUp;

use IdeaSeven\Core\Services\Menu\MenuService;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\ServiceProvider;

/**
 * Register your events here
 * Class RegisterEvents
 * @package IdeaSeven\Admin\StartUp
 */
class RegisterEvents
{
    protected $menu;

    public function __construct()
    {
        $this->menu = \App::make(MenuService::class);
    }

    /**
     * @param ServiceProvider $serviceProvider
     * @param DispatcherContract $events
     */
    public function handle(ServiceProvider $serviceProvider, DispatcherContract $events)
    {
        $events->listen('menu.item.sync', function ($model) {
            $this->menu->sync($model);
        });

        $events->listen('menu.item.destroy', function ($model) {
            $this->menu->sync($model, 'destroy');
        });
    }
}