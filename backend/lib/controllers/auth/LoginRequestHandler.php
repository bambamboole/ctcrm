<?php

namespace lib\controllers\auth;

use ctcrm\controllers\auth\Authenticator;
use lib\controllers\user\UserCreator;

class LoginRequestHandler {

    private $authenticator;
    private $creator;

    public function __construct(Authenticator $authenticator, UserCreator $creator) {
        $this->authenticator = $authenticator;
        $this->creator = $creator;
    }

    public function handleRequest($username, $password) {
        $authenticated = $this->authenticator->authenticate($username, $password);
        if ($authenticated) {
            return $this->creator->byUsername($username);
        }
        return false;
    }

}
