<?php

/*
Script for managing comment system
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once __DIR__.'/../database/dbhandler.php';
$idArticle = $_SESSION['idArticle'];
$db = Database::getInstance();

//did we get here trough comment button
if(isset($_POST['comment'])) {

    $content = str_replace(array(':', '-', '/', '*', '<', '>'), '',  $_POST['comment']);

    //error handling and verifying
    if(empty($content)) {
        header("Location: ../public/readNews.php?error=emptycomment&id=".$idArticle);
        exit();
    }
    else {
        
        //what is the username
        if(isset($_SESSION['userUsername'])) {
            $username = $_SESSION['userUsername'];
        } else if(isset($_SESSION['administratorUsername'])) {
            $username = $_SESSION['administratorUsername'];
        } else {
            $username = "Anonymous";
        }

        //inserting into database
        $sql = "INSERT INTO comments (username, content, news_id) VALUES (?, ?, ?) ;";
        $db->insertData($sql, $username, $content, $idArticle);
        header("Location: ../public/readNews.php?id=".$idArticle."&comments=success");
		exit();
        
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else if(isset($_POST['deletecom'])) {
    //deleting comments
    $comId = str_replace(array(':', '-', '/', '*', '<', '<'), '',  $_POST['comId']);

    if(empty($comId)) {
        header("Location: ../public/readNews.php?error=emptycomment&id=".$idArticle);
        exit();
    } else {
        $sql="DELETE FROM comments WHERE id = ? ;";
        $db->deleteData($sql, $comId);
        header("Location: ../public/readNews.php?id=".$idArticle."&deletecomment=success");
		exit();
    }

} else {
    header("Location: ../public/readNews.php?id=".$idArticle);
	exit();
}
