<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once __DIR__.'/../database/dbhandler.php';
$db = Database::getInstance();

if(isset($_POST['deletear'])) {
    $id = str_replace(array(':', '-', '/', '*', '<', '<'), '',  $_POST['arId']);
    
    if(empty($id)) {
        header("Location: ../public/adminManageArticles.php?error=emptyid");
        exit();
    } else {
        $sql="DELETE FROM news WHERE id = ? ;";
        $db->deleteData($sql, $id);
        header("Location: ../public/adminManageArticles.php?deletearticle=success");
		exit();
    }

} else {
    header("Location: ../public/adminManageArticles.php");
	exit();
}
