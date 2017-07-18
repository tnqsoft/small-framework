<?php

namespace Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    public function render($action, array $params = array())
    {
        global $isDevMode;

        $className = get_called_class();
        if (preg_match('/^Controller\\\\([a-zA-Z0-9\_]+)Controller$/', $className, $regs)) {
            $className = $regs[1];
        }

        $template = realpath(__DIR__.'/../View/'.$className.'/');
        $cache = realpath(__DIR__.'/../../cache/');
        $loader = new Twig_Loader_Filesystem($template);
        $options = array();
        if (!$isDevMode) {
            $options['cache'] = $cache;
        }
        $twig = new Twig_Environment($loader, $options);

        $html = $twig->render($action.'.html.twig', $params);

        return new Response($html);
    }
}
