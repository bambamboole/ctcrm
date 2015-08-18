<?php

namespace ctcrm\controllers\user;

class User implements \JsonSerializable {

  private $username;
  private $firstName;
  private $lastName;
  private $email;
  private $bitMask;
  private $dialMethod;

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
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

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getBitMask() {
    return $this->bitMask;
  }

  public function setBitMask($bitMask) {
    $this->bitMask = $bitMask;
  }

  public function getDialMethod() {
    return $this->dialMethod;
  }

  public function setDialMethod($dialMethod) {
    $this->dialMethod = $dialMethod;
  }

  function jsonSerialize() {
    return get_object_vars($this);
  }

}
