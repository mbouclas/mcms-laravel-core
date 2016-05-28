<?php

namespace IdeaSeven\Core\StartUp;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class RegisterMiddleware
 * @package IdeaSeven\Core\StartUp
 */
class RegisterMiddleware
{

    /**
     * Register all your middleware here
     * @param ServiceProvider $serviceProvider
     * @param Router $router
     */
    public function handle(ServiceProvider $serviceProvider, Router $router)
    {
        $router->middleware('role', \IdeaSeven\Core\Middleware\Role::class);
        $router->middleware('permission', \Bican\Roles\Middleware\VerifyPermission::class);
        $router->middleware('level', \Bican\Roles\Middleware\VerifyLevel::class);
    }
}