<?php

namespace ctcrm\database;

class DbConnection {

    static $connection = array();

    private $connectionDataProvider;
    
    public function __construct(\ctlib\database\DbConnectionDataProvider $connectionDataProvider) {
        $this->connectionDataProvider = $connectionDataProvider;
    }
    
    public function getConnection($database) {
        if (isset(self::$connection[$database])) {
            return self::$connection[$database];
        }

        $connectionDataDto = $this->connectionDataProvider->getConnectionData($database);
        
        self::$connection[$database] = mysqli_connect(
                $connectionDataDto->getHost(),
                $connectionDataDto->getUser(),
                $connectionDataDto->getPassword(),
                $database
        );

        mysqli_set_charset(self::$connection[$database], 'utf8');

        if (mysqli_connect_errno() > 0) {
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }

        return self::$connection[$database];
    }

}
