<?php

namespace Controller;

class DefaultController extends BaseController
{
    public function indexAction($name)
    {

        // $loader = new \Twig_Loader_Array(array(
        //     'index' => 'Hello {{ name }}!',
        // ));
        // $twig = new \Twig_Environment($loader);
        //
        // $template = $twig->render('index', array('name' => 'Fabien'));
        //
        // return new Response($template);
        return $this->render('index', array('name'=>$name));
    }

    public function aboutAction()
    {
        return new Response('About US page');
    }

    public function contactAction()
    {
        return new Response('Contact Us page');
    }
}
