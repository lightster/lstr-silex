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

use Pdo;

use Silex\Application;

class DatabaseService
{
    private $app;
    private $config;

    private $pdo;



    public function __construct(Application $app, array $config)
    {
        $this->app    = $app;
        $this->config = $config;
    }



    public function getPdo()
    {
        if (null !== $this->pdo) {
            return $this->pdo;
        }

        $dsn      = $this->config['dsn'];
        $username = isset($this->config['username']) ? $this->config['username'] : null;
        $password = isset($this->config['password']) ? $this->config['password'] : null;
        $options  = isset($this->config['driver_options']) ? $this->config['driver_options'] : null;

        $this->pdo = new PDO($dsn, $username, $password, $options);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $this->pdo;
    }



    public function query($sql, array $params = array())
    {
        $pdo   = $this->getPdo();
        $query = $pdo->prepare($sql);
        $query->execute($params);

        return $query;
    }
}
