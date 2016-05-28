<?php

namespace IdeaSeven\Core\Services\Installer;

use Illuminate\Support\Collection;

/**
 * Responsible for installing the CMS.
 * Class Install
 * @package IdeaSeven\Core\Services\Installer
 */
class Install
{
    use RegisterInstaller;

    protected $packages;
    protected $installers;

    public function __construct()
    {
        $this->packages = new Collection();
        $this->installers = new Collection();
    }

    /**
     * Get all register installer packages
     * @return Collection
     */
    public function get()
    {
        return $this->packages;
    }

    /**
     * get all the installers instantiated
     * @return Collection
     */
    public function getInstallers()
    {
        return $this->installers;
    }

    /**
     * Prepare packages for installation
     */
    public function prepare()
    {
        /**
         * If a registered package does not implement the installer interface
         * then discard it.
         */
        $this->packages->each(function ($package){
            if (! array_key_exists('IdeaSeven\Core\Services\Installer\InstallerContract',class_implements($package))){
                return;
            }

            //resolve each class
            $this->installers->push(new $package);
        });

        return $this;

    }


    /**
     * Run the installer and pray
     */
    public function execute($args = []){
        $this->installers->each(function ($installer) use ($args) {
            if (! array_key_exists($installer->packageName(), $args)){
                $args[$installer->packageName()] = [];
            }

            $installer->run($args[$installer->packageName()]);
        });
    }
    
}