<?php

namespace ctcrm\controllers\contacts;

class ContactDto implements \JsonSerializable {

  private $id;
  private $contactTitleId;
  private $firstName;
  private $lastName;
  private $contactGroupId;
  private $companyId;
  private $email;
  private $info;
  private $numberList;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getContactTitleId() {
    return $this->contactTitleId;
  }

  public function setContactTitleId($contactTitleId) {
    $this->contactTitleId = $contactTitleId;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function getContactGroupId() {
    return $this->contactGroupId;
  }

  public function setContactGroupId($contactGroupId) {
    $this->contactGroupId = $contactGroupId;
  }

  public function getCompanyId() {
    return $this->companyId;
  }

  public function setCompanyId($companyId) {
    $this->companyId = $companyId;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getInfo() {
    return $this->info;
  }

  public function setInfo($info) {
    $this->info = $info;
  }

  public function getNumberList() {
    return $this->numberList;
  }

  public function setNumberList($numberList) {
    $this->numberList = $numberList;
  }

  public function jsonSerialize() {
    return array(
      'id' => $this->id,
      'groupId' => $this->contactGroupId,
      'titleId' => $this->contactTitleId,
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'companyId' => $this->companyId,
      'email' => $this->email,
      'info' => $this->info,
      'numbers' => $this->formatNumbers()
    );
  }

    public function formatNumbers() {
        $result = array();
        foreach ($this->numberList as $index => $number) {
            foreach ($number as $key => $numberEntry) {
                $camelCaseKey = preg_replace_callback("/_(.)/", array($this, 'callbackStringToUpper'), $key);
                $result[$index][$camelCaseKey] = $numberEntry;
            }
        }
        return $result;
    }

    public function callbackStringToUpper(array $string) {
        return strtoupper($string[1]);
    }

}
