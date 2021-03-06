<?php


namespace IdeaSeven\Core\Services\Installer;


/**
 * Responsible for creating a new installer
 * Interface InstallerContract
 * @package IdeaSeven\Core\Services\Installer
 */
interface InstallerContract
{


    /**
     * @param array $args
     * @return mixed
     */
    public function run($commands = []);

    /**
     * The package name
     * @return string
     */
    public function packageName();

    /**
     * @return array
     */
    public function requiredInput();

    /**
     * Executed just before the installer runs
     * @return mixed
     */
    public function beforeRun();

    /**
     * Executed after the installer has run
     * @return mixed
     */
    public function afterRun();
}