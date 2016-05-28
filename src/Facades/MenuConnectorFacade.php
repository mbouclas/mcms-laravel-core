<?php

namespace IdeaSeven\Core\Facades;
use Illuminate\Support\Facades\Facade;

class MenuConnectorFacade extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MenuConnector'; // the IoC binding.
    }
}