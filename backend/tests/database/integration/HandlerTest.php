<?php

namespace ctcrm_tests\database\integration;


use ctcrm\database\Factory;
use ctcrm\database\Handler;
use ctlib\debug\SDebugger;

class HandlerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Handler
     */
    private $handler;

    /**
     * @group integration
     */
    public function setUp() {
        $factory = new Factory();
        $this->handler = $factory->getDbConnection('testdb');
//        Helper_TestDatabaseCreator::createTestDatabase();
    }

    public function testGetAllReturnsExpectedResult() {
        $expected = array(
            array(
                'ID' => 1,
                'TESTCOLUMNONE' => 'TESTCOLUMNONE-ROW#1',
                'TESTCOLUMNTWO' => '2015-02-24',
                'TESTCOLUMNWITHNULLS' => null
            )
        );
        $actual = $this->handler->getAll('SELECT * FROM testdb.testtable');
        SDebugger::dumpAsCodeToConsole($actual);
        $this->assertEquals($expected, $actual);
    }

    public function testGetOneReturnsExpectedResult() {
    }
}
