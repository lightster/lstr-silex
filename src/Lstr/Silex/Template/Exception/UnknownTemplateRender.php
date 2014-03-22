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

class UnknownTemplateRender extends Exception
{
    public function __construct($file_ext)
    {
        parent::__construct(
            "Unknown template renderer for file type '{$file_ext}'."
        );
    }
}
