<?php

require_once __DIR__.'/dbhandler.php';

class News {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    public function fetchNews($offset, $total_records_per_page) {
        $db = $this->connect();
        $sql = "SELECT id, title, administrator_id, date_added, short_description, picture 
                FROM news ORDER BY date_added DESC LIMIT $offset, $total_records_per_page ;";
        $result = $db->getWithoutParameters($sql);
        return $result;
        exit();
    }

    public function getArticle($id) {
        $db = $this->connect();
        $sql = "SELECT title, category, administrator_id, date_added, short_description, 
                content, picture, picture_source FROM news WHERE id = ? ;";
        $result = $db->getWithParameter($sql, $id);
        return $result;
        exit();
    }

    public function getAuthor($id) {
        $db = $this->connect();
        $sql = "SELECT name, surname FROM administrator WHERE id = ? ;";
        $result = $db->getWithParameter($sql, $id);
        foreach($result as $key => $author) {
            $result2 = ''.$author['name'].' '.$author['surname'];
        }
        return $result2;
        exit();
    }

    public function getAllCategories() {
        $db = $this->connect();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $db->getWithoutParameters($sql);
        return $result;
        exit();
    }

    public function getNewsByCategory($category) {
        $db = $this->connect();
        $sql = "SELECT id, title, date_added, short_description, administrator_id, picture 
                FROM news WHERE category = ? ;";
        $result = $db->getWithParameter($sql, $category);
        return $result;
        exit();
    }

    public function getNumberOfArticles() {
        $db = $this->connect();
        $sql = "SELECT id FROM news ;";
        $result = $db->numRows($sql);
        return $result;
        exit();
    }

    public function getNumberOfCategories() {
        $db = $this->connect();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $db->numRows($sql);
        return $result;
        exit();
    }

}
