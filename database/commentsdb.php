<?php

/*
Script with a function that fetches comments from the database for each article
*/

require_once __DIR__.'/dbhandler.php';

class Comments {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    public function fetchComments($newsId) {
        $db = $this->connect();
        $sql = "SELECT id, username, content FROM comments WHERE news_id = ? ;";
        $result = $db->getWithParameter($sql, $newsId);
        return $result;
        exit();
    }

}
