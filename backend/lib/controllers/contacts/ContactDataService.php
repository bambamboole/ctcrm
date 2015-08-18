<?php

namespace ctcrm\controllers\contacts;

use ctcrm\database\Handler;
use DB\SQL;

class ContactDataService {

  private $handler;

  public function __construct(Handler $handler) {
    $this->handler = $handler;
  }

  public function getContacts() {
    $sql = "SELECT contacts.id, contacts.contact_title_id, contacts.first_name, contacts.last_name,
      contacts.contact_group_id, contacts.email, contacts.info, companies.name AS company_name FROM contacts
      LEFT JOIN companies ON contacts.company_id = companies.id";

    $contacts = $this->handler->getAll($sql);

    $contactDtoArray = array();
    foreach ($contacts as $contact) {

      $numbersList = $this->handler->getAll("SELECT numbers.id, numbers.number, numbers.type_id FROM numbers WHERE contact_id = " . $contact['id']);
      $contactDto = $this->createContactDto($contact, $numbersList);

      $contactDtoArray[] = $contactDto;
    }

    return json_encode($contactDtoArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }

  function saveContact() {
    $request = $this->f3->get('REQUEST');

    $contact = new ContactDto();
    $contact->setId($request['id']);
    $contact->setContactGroupId($request['groupId']);
    $contact->setContactTitleId($request['titleId']);
    $contact->setFirstName($request['firstName']);
    $contact->setLastName($request['lastName']);
    $contact->setCompanyId($request['companyId']);
    $contact->setEmail($request['email']);
    $contact->setInfo($request['info']);
    //TODO: Nummern speichern
    $contact->setNumberList($request['numbers']);

    $this->f3->set('contact', get_object_vars($contact));

    $dbContact = $this->GetDbMapperInstance('contacts');
    $dbContact->copyFrom('contact');
    $dbContact->save();
  }


  function delete() {
    $result = $this->GetDbMapperInstance('contacts');
    if ($result) $result->erase();
  }

  function GetDbMapperInstance($table) {
    $id = $this->f3->get('REQUEST.id');
    $result = new DB\SQL\Mapper($this->f3->get('DB'), $table);
    if ($id) $result->load(array('id=?', $id));

    return $result;
  }

  private function createContactDto(array $contact, $numbersList) {
    $contactDto = new ContactDto();
    $contactDto->setId($contact['id']);
    $contactDto->setContactTitleId($contact['contact_title_id']);
    $contactDto->setFirstName($contact['first_name']);
    $contactDto->setLastName($contact['last_name']);
    $contactDto->setEmail($contact['email']);
    $contactDto->setContactGroupId($contact['contact_group_id']);
    $contactDto->setCompanyId($contact['company_name']);
    $contactDto->setInfo($contact['info']);
    $contactDto->setNumberList($numbersList);
    return $contactDto;
  }

}