<?php

namespace lib\controllers\user;

use ctcrm\controllers\user\MysqlHandler;

class DataService {

  private $handler;

  public function __construct(MysqlHandler $handler) {
    $this->handler = $handler;
  }

  public function getUserByUsername($username) {
    return $this->handler->fetchUserByUsername($username);
  }

}