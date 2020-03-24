<?php

require_once __DIR__.'/dbhandler.php';

class UserAndAdmin {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    public function getUsername($table, $id) {
        $db = $this->connect();
        $sql = "SELECT username FROM $table WHERE id = ? ;";
        $result = $db->getWithParameter($sql, $id);
        return $result;
        exit();
    }

    public function getAdminNameSurname($id) {
        $db = $this->connect();
        $sql = "SELECT name, surname FROM administrator WHERE id = ? ;";
        $result = $db->getWithParameter($sql, $id);
        return $result;
        exit();
    }

}
