<?php

namespace ctcrm\controllers\contactTitles;

use ctcrm\database\Handler;

class ContactTitleDataService {

    private $handler;

    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    public function getContactTitles() {
        $fetchedContactTitles = $this->handler->getAll("SELECT * FROM contact_titles");

        $contactTitles = array();
        foreach ($fetchedContactTitles as $fetchedContactTitle) {
            $contactTitle = new ContactTitleDto();
            $contactTitle->setId($fetchedContactTitle['id']);
            $contactTitle->setName($fetchedContactTitle['name']);
            $contactTitles[] = $contactTitle;
        }

        return json_encode($contactTitles);
    }
}