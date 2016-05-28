<?php

namespace IdeaSeven\Core\Helpers;

use IdeaSeven\Core\Helpers\FileSystem as FS;
use Illuminate\Filesystem\Filesystem;

/**
 * Read a config file, change it's contents then save it. Magic!!!
 *
 * Class ConfigFiles
 * @package IdeaSeven\Core\Helpers
 */
class ConfigFiles
{
    /**
     * @var
     */
    protected $configFile;
    /**
     * @var mixed
     */
    public $contents;
    /**
     * @var \IdeaSeven\Core\Helpers\FileSystem
     */
    protected $fs;

    /**
     * Pass the config file name
     *
     * ConfigFiles constructor.
     * @param string $configFile
     */
    public function __construct($configFile)
    {
        $this->configFile = $configFile;
        $this->contents = \Config::get($this->configFile);
        $this->fs = new FS(new Filesystem());
    }

    /**
     * Grab the config file as an array
     *
     * @return array
     */
    public function contents()
    {
        return $this->contents;
    }

    /**
     * Saves the config file
     */
    public function save()
    {
        $out = '<?php
        return ';
        $out .= $this->fs->var_export54($this->contents);
        $out .= ';';
        $this->fs->fs->put(config_path($this->configFile . '.php'), $out);
    }
}