<?php

namespace IdeaSeven\Core\Widgets;

use IdeaSeven\Core\Exceptions\InvalidWidgetException;
use Illuminate\Support\Collection;
use Validator;
/**
 * Class WidgetInstance
 * @package IdeaSeven\Widgets
 */
class WidgetInstance
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $instance;

    /**
     * WidgetInstance constructor.
     * @param $widget
     */
    public function __construct($widget)
    {
        $check = Validator::make($widget, [
            'name' => 'required',
            'instance' => 'required'
        ]);
        
        if ($check->fails()){
            throw new InvalidWidgetException;
        }
        
        $this->name = $widget['name'];
        $this->instance = $widget['instance'];


        /**
         * Do some validation
         */
        return new Collection($widget);
    }
}