<?php

namespace Eskirex\Component\Web;

use Eskirex\Component\Web\Exceptions\RoutingException;
use Eskirex\Component\Config\Config;
use Eskirex\Component\Dotify\Dotify;
use Eskirex\Component\HTTP\Response;
use Eskirex\Component\HTTP\Request;

class Routing
{
    protected $request;

    protected $response;

    protected $routes;


    public function __construct(Request $request, Response $response)
    {
        $this->routes = new Config('Route');
        $this->request = $request;
        $this->response = $response;

        $this->response->send($this->handle($this->getHandle()));
    }


    protected function getHandle()
    {
        return $this->routes->get($this->getRoute());
    }


    protected function getRoute()
    {
        return array_key_exists($this->request->segment(0), $this->routes->all()) ? $this->request->segment(0) : '/';
    }


    protected function handle($handler)
    {
        if (is_callable($handler)) {
            return $handler($this->request, $this->response);
        }

        if (is_string($handler)) {
            $class = Web::config('controller.namespace') . '\\' . $handler;
            $action = $this->isAction($handler);

            if (class_exists($class)) {
                $controller = $action ? new $action : new $class;
                $method = $this->getRoute() === '/' ? $this->request->segment(0) : $this->request->segment(1);

                if ($method) {
                    if (method_exists($controller, $method)) {
                        return $controller->{$method}($this->request, $this->response);
                    }
                }

                return $controller->{Web::config('default_method')}();
            }

            if (strpos($handler, '@')) {
                $parse = explode('@', $class);
                $method = $parse[1];

                if (!class_exists($parse[0])) {
                    throw new RoutingException('Invalid controller');
                }

                $controller = $action ? new $action : new $parse[0];

                if (!method_exists($controller, $method)) {
                    throw new RoutingException('Invalid method');
                }

                return $controller->{$method}($this->request, $this->response);
            }

            return $handler;
        }
    }


    protected function isAction($handler)
    {
        $requestMethod = ucfirst(strtolower($this->request->method()));
        $parseHandler = explode('\\', $handler);
        $isXhr = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false;

        $action = Web::config('controller.namespace') . '\\' . $parseHandler[0] . '\Action' . ($isXhr ? '\XHR' : '') . '\\' . $requestMethod . 'Action';

        if (class_exists($action)) {
            return $action;
        }

        return false;
    }
}