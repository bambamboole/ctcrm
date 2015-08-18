<?php

namespace ctcrm_tests\database\integration;

use ctcrm\database\Factory;

class Helper_TestDatabaseCreator {

    public static function createTestDatabase() {
        try {
            $factory = new Factory();
            $handler = $factory->getDbConnection('testdb');
            $handler->query(readfile(__DIR__ . '_files/create_testdb.sql'));
        } catch(Exception $e)  {
            echo $e->getMessage() . PHP_EOL;
        }
    }

}
