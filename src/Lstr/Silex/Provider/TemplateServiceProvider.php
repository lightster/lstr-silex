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

use Lstr\Silex\Service\TemplateService;

use Silex\Application;
use Silex\ServiceProviderInterface;

class TemplateServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['lidsys.template.options']  = array();
        $app['lidsys.template.path']     = new ArrayObject();
        $app['lidsys.template.renderer'] = array(
            'html' => $app->share(function (array $path_info, array $context = array()) use ($app) {
                return file_get_contents($path_info['path']);
            }),
            'phtml' => $app->share(function (array $path_info, array $context = array()) use ($app) {
                ob_start();
                require $path_info['path'];
                return ob_get_clean();
            }),
        );

        $app['lidsys.template'] = $app->share(function ($app) {
            $app['lidsys.template.options'] = array_replace(
                array(
                    'debug' => $app['debug'],
                ),
                $app['lidsys.template.options']
            );

            return new TemplateService($app, $app['lidsys.template.options']);
        });
    }

    public function boot(Application $app)
    {
    }
}
