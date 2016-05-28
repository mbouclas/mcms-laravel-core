<?php

namespace IdeaSeven\Core\Services\Installer;

/**
 * Responsible for registering installers from other packages
 * Class RegisterInstaller
 * @package IdeaSeven\Core\Services\Installer
 */
trait RegisterInstaller
{

    public function register($package){
        $this->packages->push($package);

        return $this;
    }
}