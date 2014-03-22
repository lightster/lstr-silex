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

class TemplateService
{
    private $app;
    private $options;
    private $path;

    public function __construct(Application $app, array $options)
    {
        $this->app     = $app;
        $this->options = $options;
        $this->path    = $app['lstr.template.path'];
    }



    public function render($name, array $context = array())
    {
        $app = $this->app;

        $file_ext = pathinfo($name, PATHINFO_EXTENSION);

        if (!isset($app['lstr.template.renderer'][$file_ext])) {
            throw new Exception\UnknownTemplateRender($file_ext);
        }
        $renderer = $app['lstr.template.renderer'][$file_ext];

        $paths   = $this->path;
        if ($paths instanceof ArrayObject) {
            $paths = $paths->getArrayCopy();
        }
        $paths[] = '';
        foreach ($paths as $path) {
            $name_path = $path . '/' . $name;
            if (file_exists($name_path)) {
                $path_info = [
                    'name' => $name,
                    'dir'  => $path,
                    'path' => $name_path,
                    'ext'  => $file_ext,
                ];
                return $renderer($path_info, $context);
            }
        }

        throw new Exception\TemplateNotFound($name, $paths);
    }
}
