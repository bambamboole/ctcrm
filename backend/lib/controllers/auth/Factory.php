<?php

namespace ctcrm\controllers\auth;

use ctcrm\database\Factory as DbFactory;
use lib\controllers\user\Factory as UserFactory;
use DB\SQL\Mapper;
use lib\controllers\auth\LoginRequestHandler;

class Factory {

  public function getLoginRequestHandler() {
    $userFactory = new UserFactory();
    return new LoginRequestHandler($this->getAuthInstance(), $userFactory->getUserCreator());
  }

  public function getAuthInstance() {
    $dbFactory = new DbFactory();
    $storage = $dbFactory->getSqlStorage(DB_CTCRM);
    $userMapper = new Mapper($storage, 'users');
    $authService = new \Auth($userMapper, array('id' => 'username', 'pw' => 'password'));
    return new Authenticator($authService);
  }

}
