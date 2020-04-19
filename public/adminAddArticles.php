<?php
   include_once __DIR__.'/../database/news.php';
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <title>Nowena</title>
    <link rel="stylesheet" href="../design/style.css">
</head>
<body>
  
    <!--Navigation bar-->
    <?php
        include 'header.php';
    ?>
    <!--end of navigation-->

    <!--wrapper-->
    <div class="container-fluid wrapper-container">
        <div class="row row-wrapper">

            <!--sidebar-->
            <?php
                include 'sidebar.php';
            ?>
            <!--end of sidebar-->

            <!--main-->
            <main class="col-9 main">

                <?php
                    $news = new News();
                    $categories = $news->getAllCategories();
                ?>

                <h1 class="text-center mt-5">New Article</h1>    
                <form enctype="multipart/form-data" class="center-divv" name="adminaddForm" action="../includes/adminaddar.inc.php" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>    
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        <p id="artitle"></p>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label> 
                        <input type="text" class="form-control" id="author" name="author" placeholder="Author">
                        <p id="arauthor"></p>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <?php 
                                if($categories && !empty($categories)) {
                                    foreach($categories as $key => $category) {
                                        echo '<option>';
                                        echo $category["category"];
                                        echo '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <p id="arcategory"></p>
                    </div>
                    <div class="form-group">
                    <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="20" cols="30"></textarea>
                        <p id="arcontent"></p>
                    </div>
                    <div class="form-group">
                        <label for="shortDesc">Short description</label>
                        <textarea name="shortDesc" id="shortDesc" class="form-control" rows="5" cols="30"></textarea>
                        <p id="arshortdesc"></p>
                    </div>
                    <div class="form-group">
                        <label for="chooseimg">Choose a picture</label>    
                        <input type="file" name="chooseimg" id="chooseimg" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="imgsource">Image source</label>
                        <input type="text" class="form-control" id="imgsource" name="imgsource" placeholder="Image Source">
                        <p id="arimgsource"></p>
                    </div>
                    <div class="form-group">
                        <button class="d-block my-3 btn btn-dark float-right" type="submit" name="add-article">Add</button>
                    </div>
                </form>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end of wrapper-->


</body>
</html>
