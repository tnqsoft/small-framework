<?php

namespace Services;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class Core implements HttpKernelInterface
{
    /**
     * @var RouteCollection
     */
    protected $routes;

    /**
     * @var array
     */
    protected $routesConfigs;

    public function __construct()
    {
        $this->routes = new RouteCollection();
        $this->routesConfigs = Yaml::parse(file_get_contents(__DIR__.'/../../config/routes.yml'));
        $this->loadController();
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        // create a context using the current request
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controllerName = 'Controller\\'.$attributes['controller'].'Controller';
            $controller = new $controllerName();
            $action = $attributes['action'].'Action';
            unset($attributes['controller']);
            unset($attributes['action']);
            $response = call_user_func_array(array($controller, $action), $attributes);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Page not found!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    public function map($path, $controller, $action)
    {
        $this->routes->add($path, new Route(
            $path,
            array(
                'controller' => $controller,
                'action' => $action,
            )
        ));
    }

    private function loadController()
    {
        if (empty($this->routesConfigs)) {
            return;
        }
        foreach ($this->routesConfigs as $controller => $routingConfig) {
            $prefix = !empty($routingConfig['prefix'])?$routingConfig['prefix']:'';
            if (!empty($routingConfig['routing'])) {
                foreach ($routingConfig['routing'] as $action => $url) {
                    $path = $prefix.(!empty($url)?$url:'');
                    $this->map($path, $controller, $action);
                }
            }
        }
    }
}
