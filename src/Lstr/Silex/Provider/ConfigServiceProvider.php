<?php
/*
 * Lstr/Silex source code
 *
 * Copyright Matt Light <matt.light@lightdatasys.com>
 *
 * For copyright and licensing information, please view the LICENSE
 * that is distributed with this source code.
 */

namespace Lstr\Silex\Provider;

use ArrayObject;

use Lstr\Silex\Service\ConfigService;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['lidsys.config'] = $app->share(function ($app) {
            return new ConfigService($app);
        });
    }

    public function boot(Application $app)
    {
    }
}
