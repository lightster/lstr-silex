<?php
/*
 * Lstr/Silex source code
 *
 * Copyright Matt Light <matt.light@lightdatasys.com>
 *
 * For copyright and licensing information, please view the LICENSE
 * that is distributed with this source code.
 */

namespace Lstr\Silex\Config;

use ArrayObject;

use Silex\Application;

class ConfigService
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app     = $app;
    }



    public function load(array $glob_paths)
    {
        $config = array();

        foreach ($glob_paths as $glob_path) {
            $paths = glob($glob_path);
            foreach ($paths as $path) {
                $config = array_replace_recursive($config, require $path);
            }
        }

        return $config;
    }
}
