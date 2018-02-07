<?php

namespace Drupal\fpntc_train\Service;


interface FpntcTrainCookieServiceInterface
{
    public function getCookie();
    public function destroyCookie();
}