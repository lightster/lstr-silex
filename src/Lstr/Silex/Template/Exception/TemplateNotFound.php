<?php
/*
 * Lstr/Silex source code
 *
 * Copyright Matt Light <matt.light@lightdatasys.com>
 *
 * For copyright and licensing information, please view the LICENSE
 * that is distributed with this source code.
 */

namespace Lstr\Silex\Template\Exception;

use Exception;

class TemplateNotFound extends Exception
{
    public function __construct($name, array $paths)
    {
        parent::__construct(
            "Could not find template '{$name}'. Checked in:\n - " . implode("\n - ", $paths) . "\n"
        );
    }
}
