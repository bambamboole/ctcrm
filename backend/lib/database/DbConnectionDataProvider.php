<?php

namespace ctcrm\database;

class DbConnectionDataProvider {
    
    private $connectionData = array(
        'ctcrm' => array(
            'host' => 'gw.ct-server.de',
            'user' => 'ctcrm',
            'password' => '#begreifen69!',
        )
    );
    
    /**
     * @param type $database
     * @return DbConnectionDataDto
     * @throws CtDbNotFoundException
     */
    public function getConnectionData($database) {
        if (array_key_exists($database, $this->connectionData)) {
            return $this->createDto($this->connectionData[$database]);
        }
        
        throw new CtDbNotFoundException("{$database} could not be found.");
    }
    
    private function createDto($data) {
        return new DbConnectionDataDto(
            $data['host'], $data['user'], $data['password']
        );
    }

}
