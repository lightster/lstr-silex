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

use Lstr\Silex\Service\DatabaseService;

use Silex\Application;
use Silex\ServiceProviderInterface;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    private $db_service_name;
    private $config_service_name;
    private $config_key;



    public function __construct($db_service_name, $config_service, $config_key)
    {
        $this->db_service_name     = $db_service_name;
        $this->config_service_name = $config_service;
        $this->config_key          = $config_key;
    }



    public function register(Application $app)
    {
        $config_service_name = $this->config_service_name;
        $config_key          = $this->config_key;

        $app[$this->db_service_name] = $app->share(
            function (
                $app
            ) use (
                $config_service_name,
                $config_key
            ) {
                return new DatabaseService($app, $app[$config_service_name][$config_key]);
            }
        );
    }



    public function boot(Application $app)
    {
    }
}
