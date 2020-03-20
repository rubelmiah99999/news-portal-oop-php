<?php

require_once __DIR__.'/dbFunctions.php';

class UserAndAdmin {

    public function getUsername($table, $id) {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT username FROM $table WHERE id = ? ;";
        $result = $dbFunctions->stmtWithOneParam($sql, $id);
        return $result;
        exit();
    }

    public function getAdminNameSurname($id) {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT name, surname FROM administrator WHERE id = ? ;";
        $result = $dbFunctions->stmtWithOneParam($sql, $id);
        return $result;
        exit();
    }

}