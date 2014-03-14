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

use Lstr\Assetrinc\AssetService;
use Lstr\Assetrinc\ResponseAdapter\Symfony as SymfonyResponseAdapter;

use Silex\Application;
use Silex\ServiceProviderInterface;

class AssetServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['lstr.asset.path'] = new ArrayObject();

        $app['lstr.asset'] = $app->share(function ($app) {
            $options = array_replace(
                array(
                    'debug' => $app['config']['debug'],
                ),
                $app['config']['lstr.asset.assetrinc']
            );
            return new AssetService(
                $app['lstr.asset.path'],
                $app['config']['lstr.asset.url_prefix'],
                $options
            );
        });
        $app['lstr.asset.responder'] = $app->share(function ($app) {
            return new SymfonyResponseAdapter($app['lstr.asset']);
        });
    }

    public function boot(Application $app)
    {
    }
}
