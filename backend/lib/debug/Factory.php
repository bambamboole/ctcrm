<?php

namespace ctcrm\debug;

class Factory {

    public function getInstance() {
        return new Debugger();
    }
}
