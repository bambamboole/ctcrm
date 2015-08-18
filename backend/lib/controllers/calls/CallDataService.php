<?php

namespace ctcrm\controllers\calls;

use ctcrm\controllers\contacts\ContactDto;
use ctcrm\database\Handler;

class CallDataService {

  private $handler;

  public function __construct(Handler $handler) {
    $this->handler = $handler;
  }

  public function getCalls() {
    $sql = sprintf(
      "SELECT * FROM %s.%s AS a RIGHT JOIN %s AS b ON (a.contact_id = b.id_contact)",
      DB_CTCRM, 'calls', 'contacts'
    );

    $calls = $this->handler->getAll($sql);

    $callDtoArray = array();
    foreach ($calls as $call) {
      $contact = new ContactDto();
      $contact->setId($call['contact_id']);
      $contact->setCompanyId($call['company_id']);
      $contact->setContactGroupId($call['contact_group_id']);
      $contact->setContactTitleId($call['contact_title_id']);
      $contact->setFirstName($call['first_name']);
      $contact->setLastName($call['last_name']);
      $contact->setEmail($call['email']);
      $contact->setInfo($call['info']);

      $callDto = new CallDto();
      $callDto->setId($call['id']);
      $callDto->setContact($contact);
      $callDto->setDirection($call['direction']);
      $callDto->setNumberId($call['number_id']);
      $callDto->setState($call['state']);
      $callDto->setTimestamp($call['timestamp']);
      $callDto->setNote($call['note']);

      $callDtoArray[] = $callDto;
    }

    return json_encode($callDtoArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }
}