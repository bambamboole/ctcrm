<?php

namespace ctcrm\controllers\auth;

class Authenticator {

  private $authService;

  public function __construct(\Auth $authService) {
    $this->authService = $authService;
  }

  public function authenticate($username, $password) {
    return $this->authService->login($username, $password);
  }

}
