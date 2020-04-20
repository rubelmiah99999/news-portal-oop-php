<?php

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
        if(is_uploaded_file($_FILES['chooseimg']['tmpname'])) {
            $image = addslashes(file_get_contents($_FILES['chooseimg']['tmpname']));
        }
    } else {
        $imagename = null;
        $imgsource = null;
    }
    //$imagename = $_FILES['chooseimg'];
    //$image = file_get_contents($imagename);
    //$fInfo = new finfo(FILEINFO_MIME);
    //$mimeType = $fInfo->file($imagename);

    $date = date('Y-m-d H:i:s');

    $db = Database::getInstance();

    if(empty($title) || empty($author) || empty($category)  || empty($content)  || empty($shortDesc)) {
        header("Location: ../public/adminAddArticles.php?error=emptyfields");
        exit();
    }   else if(filesize($imagename) > 16777215) {
        header("Location: ../public/adminAddArticles.php?error=imagesize");
        exit();
    } /*else if($mimeType !== 'image/jpeg' || $mimeType !== 'image/pjpeg' || $mimeType !== 'image/png' || $mimeType !== 'image/gif') {
        header("Location: ../public/adminAddArticles.php?error=imagetype");
        exit();
    }*/ else {
        $sql = "INSERT INTO news (author, title, category, date_added, content, short_description, picture, picture_source)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?) ;";
        $db->insertArticle($sql, $author, $title, $category, $date, $content, $shortDesc, $image, $imgsource);
        header("Location: ../public/adminAddArticles.php?signup=success");
        exit();
    }

} else {
    header("Location: ../public/adminAddArticles.php");
}
