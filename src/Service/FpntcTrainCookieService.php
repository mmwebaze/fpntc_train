<?php

namespace Drupal\fpntc_train\Service;


use GuzzleHttp\Cookie\CookieJar;

class FpntcTrainCookieService implements FpntcTrainCookieServiceInterface
{
    private $cookie;
    public function __construct()
    {
        $this->cookie = new CookieJar();
    }

    public function getCookie(){
        return $this->cookie;
    }
    public function destroyCookie(){

    }
}