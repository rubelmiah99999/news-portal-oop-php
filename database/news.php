<?php

require_once __DIR__.'/dbFunctions.php';

class News {

    public function fetchNews($offset, $total_records_per_page) {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT id, title, administrator_id, date_added, short_description, picture 
                FROM news ORDER BY date_added DESC LIMIT $offset, $total_records_per_page ;";
        $result = $dbFunctions->stmtWithotParam($sql);
        return $result;
        exit();
    }

    public function getArticle($id) {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT title, category, administrator_id, date_added, short_description, 
                content, picture, picture_source FROM news WHERE id = ? ;";
        $result = $dbFunctions->stmtWithOneParam($sql, $id);
        return $result;
        exit();
    }

    public function getAuthor($id) {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT name, surname FROM administrator WHERE id = ? ;";
        $result = $dbFunctions->stmtWithOneParam($sql, $id);
        return $result;
        exit();
    }

    public function getAllCategories() {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $dbFunctions->stmtWithotParam($sql);
        return $result;
        exit();
    }

    public function getNewsByCategory($category) {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT id, title, date_added, short_description, administrator_id, picture 
                FROM news WHERE category = ? ;";
        $stmt = $this->mysqli->stmt_init($this->con);
        $result = $dbFunctions->stmtWithOneParam($sql, $category);
        return $result;
        exit();
    }

    public function getNumberOfArticles() {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT COUNT(id) as quantity FROM news ;";
        $result = $dbFunctions->getQuantity($sql);
        return $result;
        exit();
    }

    public function getNumberOfCategories() {
        $dbFunctions = new DatabaseFunctions();
        $sql = "SELECT COUNT( DISTINCT category ) as quantity FROM news ;";
        $result = $dbFunctions->getQuantity($sql);
        return $result;
        exit();
    }

}