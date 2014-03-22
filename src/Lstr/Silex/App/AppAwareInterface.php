<?php
/*
 * Lstr/Silex source code
 *
 * Copyright Matt Light <matt.light@lightdatasys.com>
 *
 * For copyright and licensing information, please view the LICENSE
 * that is distributed with this source code.
 */

namespace Lstr\Silex\Application\Aware;

use Silex\Application;

interface AppAwareInterface
{
    public function setSilexApplication(Application $app);
    public function getSilexApplication();
}
