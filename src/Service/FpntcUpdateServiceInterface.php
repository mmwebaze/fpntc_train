<?php

namespace Drupal\fpntc_train\Service;


interface FpntcUpdateServiceInterface {
  public function updateUser($trainId, $email);
}