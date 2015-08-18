<?php

namespace ctcrm_tests\database\integration;

use ctcrm\database\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Factory
     */
    private $factory;
    private $testSetup = array();

    /**
     * @group integration
     */
    public function setUp() {
        $this->testSetup = array(
            'database' => 'testdb'
        );

        $this->factory = new Factory();
    }

    public function testIsInstantiable() {
        $this->assertInstanceOf('ctcrm\database\Factory', $this->factory);
    }

    public function testHandlerIsReturnedWhenTestDbIsRequested() {
        $this->assertInstanceOf(
            'ctcrm\database\Handler',
            $this->factory->getDbConnection($this->testSetup['database'])
        );
    }
}