<?php

namespace ctcrm\controllers\calls;

use ctcrm\controllers\contacts\ContactDto;

class CallDto implements \JsonSerializable {

  private $id;
  private $numberId;
  private $companyId;
  private $timestamp;
  private $duration;
  private $note;
  private $state;
  private $direction;

  /**
   * @var ContactDto
   */
  private $contact;


  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getNumberId() {
    return $this->numberId;
  }

  public function setNumberId($numberId) {
    $this->numberId = $numberId;
  }

  public function getCompanyId() {
    return $this->companyId;
  }

  public function setCompanyId($companyId) {
    $this->companyId = $companyId;
  }

  public function getTimestamp() {
    return $this->timestamp;
  }

  public function setTimestamp($timestamp) {
    $this->timestamp = $timestamp;
  }

  public function getDuration() {
    return $this->duration;
  }

  public function setDuration($duration) {
    $this->duration = $duration;
  }

  public function getNote() {
    return $this->note;
  }

  public function setNote($note) {
    $this->note = $note;
  }

  public function getState() {
    return $this->state;
  }

  public function setState($state) {
    $this->state = $state;
  }

  public function getDirection() {
    return $this->direction;
  }

  public function setDirection($direction) {
    $this->direction = $direction;
  }

  public function getContact() {
    return $this->contact;
  }

  public function setContact($contact) {
    $this->contact = $contact;
  }


  public function jsonSerialize() {
    return array(
      'id' => $this->id,
      'number_id' => $this->numberId,
      'company_id' => $this->companyId,
      'timestamp' => $this->timestamp,
      'duration' => $this->duration,
      'note' => $this->note,
      'state' => $this->state,
      'direction' => $this->direction,
      'contact' => array(
        'id' => $this->contact->getId(),
        'company_id' => $this->contact->getCompanyId(),
        'contact_group_id' => $this->contact->getContactGroupId(),
        'contact_title_id' => $this->contact->getContactTitleId(),
        'email' => $this->contact->getEmail(),
        'first_name' => $this->contact->getFirstName(),
        'info' => $this->contact->getInfo(),
        'number_list' => $this->contact->getNumberList(),
        'last_name' => $this->contact->getLastName(),
      ),
    );
  }
}
