<?php

namespace ctcrm\controllers\numberTypes;

use ctcrm\database\Handler;

class NumberTypeDataService {

    private $handler;

    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    public function getNumberTypes() {
        $fetchedNumberTypes = $this->handler->getAll("SELECT * FROM number_types");

        $numberTypes = array();
        foreach ($fetchedNumberTypes as $fetchedNumberType) {
            $numberType = new numberTypeDto();
            $numberType->setId($fetchedNumberType['id']);
            $numberType->setName($fetchedNumberType['name']);
            $numberTypes[] = $numberType;
        }

        return json_encode($numberTypes);
    }
}