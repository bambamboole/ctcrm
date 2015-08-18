<?php

namespace ctcrm_tests\debug\unit;

use ctcrm\debug\Debugger;

class DebuggerTest extends \PHPUnit_Framework_TestCase {


    /**
     * @var Debugger
     */
    private $debugger;

    public function setUp() {
        $this->debugger = new Debugger();
    }

    public function testIsInstantiable() {
        $this->assertInstanceOf('ctcrm\debug\Debugger', $this->debugger);
    }

    public function testDump2Browser() {
        $testValue = "hi";

        $expected = sprintf("<pre>string(2) \"%s\"\n</pre>", $testValue);

        ob_start();
        $this->debugger->dump2browser("hi");
        $actual = ob_get_clean();

        $this->assertSame($expected, $actual);
    }

    public function testX() {
        $testValue = array();

        $expected = sprintf("<pre>string(2) \"%s\"\n</pre>", $testValue);

        ob_start();
        $this->debugger->dump2browser("hi");
        $actual = ob_get_clean();

        $this->assertSame($expected, $actual);
    }

}
