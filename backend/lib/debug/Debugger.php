<?php

namespace ctcrm\debug;

class Debugger {


    public function dump2console($var, $label="") {
        echo $label . PHP_EOL;
        $this->dump($var);
    }

    public function dump2browser($var) {
        echo "<pre>";
        $this->dump($var);
        echo "</pre>";
    }

    public function dumpAsCode2ToConsole($var) {

    }

    private function dump($var) {
        var_dump($var);
    }
}
