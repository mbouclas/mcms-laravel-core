<?php

namespace IdeaSeven\Core\Installer;


use IdeaSeven\Core\Services\Installer\InstallerContract;

class Install implements InstallerContract
{

    public $package = 'Core';


    /**
     * @param array $commands
     * @return $this
     */
    public function run($commands = [])
    {

        $this->beforeRun();
        $this->afterRun();
        return $this;
    }

    /**
     * @return string
     */
    public function packageName()
    {
        return $this->package;
    }

    /**
     * @return array
     */
    public function requiredInput()
    {
        return [
            'name' => ['input' => 'A name']
        ];
    }

    /**
     * Executed just before the installer runs
     * @return $this
     */
    public function beforeRun()
    {
        event('installer.package.run.before',
            [$this->package . ' about to install']);

        return $this;
    }

    /**
     * Executed after the installer has run
     * @return $this
     */
    public function afterRun()
    {
        event('installer.package.run.after',
            [$this->package . ' was installed','info']);
        
        return $this;
    }
}