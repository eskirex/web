<?php

namespace Eskirex\Component\Web;

use Eskirex\Component\Config\Config;
use Eskirex\Component\Dotify\Dotify;
use Eskirex\Component\HTTP\Request;
use Eskirex\Component\HTTP\Response;
use Eskirex\Component\Session\Session;
use Eskirex\Component\Web\Traits\WebTrait;

class Web
{
    use WebTrait;

    protected $request;

    protected $response;


    public function __construct()
    {
        Config::config([
            'dir' => self::config('config.dir')
        ]);

        $this->request = new Request();
        $this->response = new Response();

        (new Session())->start();
        new Routing($this->request, $this->response);
    }


    /**
     * @param array|string $_
     * @return mixed
     */
    public static function config($_ = null)
    {
        return self::doSetConfig($_);
    }
}