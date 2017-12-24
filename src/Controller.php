<?php

namespace Eskirex\Component\Web;

use Eskirex\Component\HTTP\Request;
use Eskirex\Component\HTTP\Response;

abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response,
     */
    protected $response;

    /**
     * @var View
     */
    protected $view;


    public function request()
    {
        if (self::$request === null) {
            self::$request = new Request();
        }

        return static::$request;
    }


    public function response()
    {
        if (self::$response === null) {
            self::$response = new Response();
        }

        return static::$response;
    }


    public function view($name = null)
    {
        if (self::$view === null) {
            self::$view = new View($name);
        }

        return static::$view;
    }
    

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
    }
}