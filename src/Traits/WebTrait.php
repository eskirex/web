<?php

namespace Eskirex\Component\Web\Traits;

use Eskirex\Component\Dotify\Dotify;

trait WebTrait
{
    /**
     * @var Dotify
     */
    public static $config;


    protected static function doSetConfig($_ = null)
    {
        if (static::$config === null) {
            static::$config = new Dotify();
        }

        if ($_ !== null) {
            if (is_string($_)) {
                return static::$config->get($_);
            }

            if (is_array($_)) {
                static::$config->setArray($_);
            }
        }

        if (!is_dir(static::$config->get('model.dir'))) {

        }

        if (!is_dir(static::$config->get('view.dir'))) {

        }

        if (!is_dir(static::$config->get('controller.dir'))) {

        }

        if (!is_dir(static::$config->get('config.dir'))) {

        }

        if (!is_dir(static::$config->get('var.dir'))) {

        }
    }
}