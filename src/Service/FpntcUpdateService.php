<?php

namespace Drupal\fpntc_train\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class FpntcUpdateService implements FpntcUpdateServiceInterface {
  protected $entityTypeManager;
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  public function updateUser($trainId, $email){

    $storage = $this->entityTypeManager->getStorage('user');
    $ids = $storage->getQuery()->condition('mail', $email)->execute();
    $users = $storage->loadMultiple($ids);
    foreach ($users as $user){
      print($user->id());
    }
  }
}