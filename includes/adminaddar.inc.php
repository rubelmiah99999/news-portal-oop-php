<?php

/*
Script that adds articles to the database once administrator choses to do so,
and if everything is proper
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_POST['add-article'])) {
    require_once __DIR__.'/../database/dbhandler.php';

    $title = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['title']);
    $author = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['author']);
    $category = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['category']);
    $content = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['content']);
    $shortDesc = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['shortDesc']);
    $imgsource = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['imgsource']);

    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['chooseimg']['tmp_name'])) {
            $image = addslashes(file_get_contents($_FILES['chooseimg']['tmp_name']));
        }
    } else {
        $image = null;
        $imgsource = null;
    }

    $date = date('Y-m-d H:i:s');

    $db = Database::getInstance();

    if(empty($title) || empty($author) || empty($category)  || empty($content)  || empty($shortDesc)) {
        header("Location: ../public/adminAddArticles.php?error=emptyfields");
        exit();
    } else {
        $sql = "INSERT INTO news (author, title, category, date_added, content, short_description, picture, picture_source)
        VALUES ('".$author."', '".$title."', '".$category."','".$date."', '".$content."', '".$shortDesc."', '".$image."', '".$imgsource."' ) ;";
        $db->runQuery($sql);
        header("Location: ../public/adminAddArticles.php?add=success");
        exit();
    }

} else {
    header("Location: ../public/adminAddArticles.php");
    exit();
}
