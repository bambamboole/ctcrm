<?php

namespace ctcrm\controllers\contactGroups;

use ctcrm\database\Handler;

class ContactGroupDataService {

    private $handler;

    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    public function getContactGroups() {
        $fetchedContactGroups = $this->handler->getAll("SELECT * FROM contact_groups");

        $contactGroups = array();
        foreach ($fetchedContactGroups as $fetchedContactGroup) {
            $contactGroup = new ContactGroupDto();
            $contactGroup->setId($fetchedContactGroup['id']);
            $contactGroup->setName($fetchedContactGroup['name']);
            $contactGroups[] = $contactGroup;
        }

        return json_encode($contactGroups);
    }

    public function saveContactGroup(ContactGroupDto $dto) {
        $sql = sprintf("UPDATE contact_groups SET name = '%s' WHERE id = %d", $dto->getName(), $dto->getId());
        $this->handler->query($sql);
    }
}