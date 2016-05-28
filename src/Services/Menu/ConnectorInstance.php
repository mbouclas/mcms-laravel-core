<?php

namespace IdeaSeven\Core\Services\Menu;

use IdeaSeven\Core\Exceptions\InvalidMenuConnectorException;
use Illuminate\Support\Collection;
use Validator;

class ConnectorInstance
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $connector;

    /**
     * ConnectorInstance constructor.
     * @param $connector
     */
    public function __construct(array $connector)
    {
        $check = Validator::make($connector, [
            'name' => 'required',
            'connector' => 'required'
        ]);

        if ($check->fails()){
            throw new InvalidMenuConnectorException($check->messages());
        }

        $this->name = $connector['name'];
        $this->connector = $connector['connector'];

        /**
         * Do some validation
         */
        return new Collection($connector);
    }
}