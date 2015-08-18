<?php

namespace ctcrm\database;

class DbConnectionDataDto {
   
    private $host;
    private $user;
    private $password;
    
    public function __construct($host, $user, $password) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }
    
    public function getHost() {
        return $this->host;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function getPassword() {
        return $this->password;
    }

}
