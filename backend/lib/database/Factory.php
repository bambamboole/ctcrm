<?php

namespace ctcrm\database;

class Factory {

    public function getDbConnection($database) {
        return new Handler($this->getSqlStorage($database));
    }

    public function getSqlStorage($database) {
        $options = array(
          \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // generic attribute
          \PDO::ATTR_PERSISTENT => false,  // we want to use persistent connections
          \PDO::MYSQL_ATTR_COMPRESS => true, // MySQL-specific attribute
        );

        return new \DB\SQL('mysql:host=gw.ct-server.de;port=3306;dbname=' . $database, DB_CTCRM, '#begreifen69!', $options);
    }

}
 