<?php

namespace ctcrm\debug;

class SDebugger {


    public static function dump2console($var, $label="") {
        echo $label . PHP_EOL;
        self::dump($var);
    }

    public static function dump2browser($var) {
        echo "<pre>";
        self::dump($var);
        echo "</pre>";
    }

    public static function dumpAsCode2Console($var) {
        
    }

    private static function dump($var) {
        var_dump($var);
    }
}
