<?php

namespace ctcrm\database;

class Handler {

    private $db;
    private $queryResult;

    public function __construct(\DB\SQL $db) {
        $this->db = $db;
    }

    public function getAll($sql) {
        $args = func_get_args();

        reset($args);
        unset($args[key($args)]);

        return $this->db->exec($sql, $args);
    }
    
    public function query($sql) {
        return $this->db->exec($sql);
    }
    
    public function getOne($sql) {
        return $this->db->exec($sql);
    }
    
    public function getRow($sql) {
        $args = func_get_args();

        reset($args);
        unset($args[key($args)]);

        $data = $this->db->exec($sql, $args);

        $row = array();
        foreach ($data[0] as $key => $value) {
            $row[$key] = $value;
        }
        return $row;
    }
    
    public function getCol($sql)
    {
        $this->queryResult = $this->db->query($sql);
        $this->checkForErrors();

        while ($row = $this->queryResult->fetch_assoc()) {
            $resultRow[] = $row;
        }

        $result = array();
        if (!is_null($resultRow)) {
            foreach ($resultRow as $column => $value) {
                $result[$column] = $value;
            }
        }

        return $result;
    }
    
    private function checkForErrors() {
        if ($this->db->errno > 0) {
            throw new CtDbException($this->createExceptionMessage());
        }
    }
    
    private function createExceptionMessage() {
        return sprintf("[%s] %s", $this->db->errno, $this->db->error);
    }

}
