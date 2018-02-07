<?php
namespace Drupal\fpntc_train\Service;

interface FpntcTrainLoginServiceInterface
{
    public function login($cookie);
    public function loginStatus($cookie);
    public function logout($cookie);
}