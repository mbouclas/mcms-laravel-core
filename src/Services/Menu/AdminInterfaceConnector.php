<?php

namespace IdeaSeven\Core\Services\Menu;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AdminInterfaceConnector
 * @package IdeaSeven\Core\Services\Menu
 */
abstract class AdminInterfaceConnector
{
    /**
     * Set this to the module name you want to show in the admin
     *
     * @var
     */
    protected $moduleName;

    /**
     * Set this to the array of sections you want (items, categories, ...)
     *
     * @var array
     */
    protected $sections = [];

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Set your module settings here, like api endpoint
     * @var array
     */
    protected $settings = [
        'endPoint' => '',
        'perPage' => 10
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     *  Initializes the render process
     */
    public function run()
    {
        return new Collection([
            'name' => $this->moduleName,
            'connector' => [
                'model' => get_class($this->model),
                'sections' => $this->sections,
                'settings' => $this->settings,
            ]
        ]);
    }

    /**
     * @param array $filters
     * @return Collection
     */
    public function filter(array $filters = [])
    {
        $toReturn = new Collection();


        $toReturn->results = $this->model->where($filters)->paginate();


        return $toReturn;
    }
}