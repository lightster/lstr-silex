<?php
/*
 * Lstr/Silex source code
 *
 * Copyright Matt Light <matt.light@lightdatasys.com>
 *
 * For copyright and licensing information, please view the LICENSE
 * that is distributed with this source code.
 */

namespace Lstr\Silex\Template;

use ArrayObject;

use Silex\Application;
use Silex\ServiceProviderInterface;

class TemplateServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['lstr.template.options']  = array();
        $app['lstr.template.path']     = new ArrayObject();
        $app['lstr.template.renderer'] = array(
            'html' => $app->share(function (array $path_info, array $context = array()) use ($app) {
                return file_get_contents($path_info['path']);
            }),
            'phtml' => $app->share(function (array $path_info, array $context = array()) use ($app) {
                ob_start();
                require $path_info['path'];
                return ob_get_clean();
            }),
        );

        $app['lstr.template.configurer'] = $app->protect(function (Application $app) {
            $app['lstr.template.options'] = array_replace(
                array(
                    'debug' => !empty($app['debug']),
                ),
                $app['lstr.template.options']
            );
        });

        $app['lstr.template'] = $app->share(function ($app) {
            $configurer = $app['lstr.template.configurer'];
            $configurer($app);

            return new TemplateService($app, $app['lstr.template.options']);
        });
    }

    public function boot(Application $app)
    {
    }
}
