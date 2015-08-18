<?php

namespace lib\controllers\user;

use ctcrm\controllers\user\MysqlHandler;

class Factory {

  public function getUserCreator() {
    $dbFactory = new \ctcrm\database\Factory();
    $db = $dbFactory->getDbConnection('ctcrm');

    return new UserCreator(
      new DataService(new MysqlHandler($db))
    );
  }

}
