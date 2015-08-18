<?php

namespace lib\controllers\user;

use ctcrm\controllers\user\User;
use ctcrm\debug\SDebugger;

class UserCreator {

  private $dataService;

  public function __construct(DataService $dataService) {
    $this->dataService = $dataService;
  }

  public function byUsername($username) {
    $userData = $this->dataService->getUserByUsername($username);
    return $this->createUser($userData);
  }

  private function createUser(array $userData) {
    $user = new User();
    $user->setUsername($userData['username']);
    $user->setEmail($userData['email']);
    $user->setFirstName($userData['first_name']);
    $user->setLastName($userData['last_name']);
    $user->setBitMask($userData['bit_mask']);
    $user->setDialMethod($userData['dial_method']);
    return $user;
  }

}
