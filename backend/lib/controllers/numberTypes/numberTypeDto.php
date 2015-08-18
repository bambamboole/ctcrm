<?php

namespace ctcrm\controllers\numberTypes;

class NumberTypeDto implements \JsonSerializable {

    private $id;
    private $name;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    function jsonSerialize() {
        return array(
            'id' => $this->id,
            'name' => $this->name
        );
    }

}
