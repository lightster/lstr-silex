<?php
/*
 * Lstr/Silex source code
 *
 * Copyright Matt Light <matt.light@lightdatasys.com>
 *
 * For copyright and licensing information, please view the LICENSE
 * that is distributed with this source code.
 */

namespace Lstr\Silex\Database;

use Silex\Application;
use Silex\ServiceProviderInterface;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['lstr.db'] = $app->protect(function ($config) use ($app) {
            return $app->share(function (Application $app) use ($config) {
                if (is_callable($config)) {
                    $config = call_user_func_array($config, array($app));
                }
                return new DatabaseService($app, $config);
            });
        });
    }



    public function boot(Application $app)
    {
    }
}
