<?php

namespace ctcrm\controllers\user;

use ctcrm\database\Handler;

class MysqlHandler {

  private $handler;

  public function __construct(Handler $handler) {
    $this->handler = $handler;
  }

  public function fetchUserByUsername($username) {
    $sql = sprintf("SELECT * FROM %s.%s WHERE username=?", DB_CTCRM, 'users');
    return $this->handler->getRow($sql, $username);
  }

}
