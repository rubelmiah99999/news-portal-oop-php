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
<body onload="showModal()">
  
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

                <div class="main-card">
                    <?php

                        $newss = new News();

                        //pagination
                        //get the current page number
                        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                            $page_no = $_GET['page_no'];
                        } else {
                            $page_no = 1;
                        }

                        //set total records per page, offset values etc
                        $total_records_per_page = 10;
                        $offset = ($page_no-1) * $total_records_per_page;
                        $previous_page = $page_no - 1;
                        $next_page = $page_no + 1;
                        $adjacents = "2";
                        $total_records = $newss->getNumberOfArticles();
                        $total_no_of_pages = ceil($total_records / $total_records_per_page);
                        $second_last = $total_no_of_pages - 1; //total pages minus 1

                        ?>

                        <table class="table" id="articleTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">AUTHOR</th>
                                    <th scope="col">DATE ADDED</th>
                                </tr>
                            </thead>
                            <tbody>
                        

                            <?php
                            //function from database/news.php
                            //display all news
                            $news = $newss->fetchNews($offset, $total_records_per_page);

                            if ( $news && !empty($news) ) {

                                foreach ($news as $key => $article) {

                                    echo '<tr>';
                                        echo '<td>';
                                            echo $article['id'];
                                        echo '</td>';
                                        echo '<td>';
                                            echo $article['title'];
                                        echo '</td>';
                                        echo '<td>';
                                            echo $article['author'];
                                        echo '</td>';
                                        echo '<td>';
                                            echo $article['date_added'];
                                        echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                        <!--end of table-->
                </div>

                <!--pagination-->
                <div class="navbar navbar-expand navbar-dark bg-dark 
                    d-flex justify-content-center">

                    <ul class="pagination navbar-nav">
                        <?php if($page_no > 1){
                        echo "<li><a href='?page_no=1'>First Page</a></li>";
                        } ?>
                            
                        <li class="page-item sr-only" <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                            <a class="page-link" aria-label="Previous" <?php if($page_no > 1){
                            echo "href='?page_no=$previous_page'";
                            } ?>>Previous</a>
                        </li>

                        <li class="page-item  white-font">
                            Page <?php echo $page_no." of ".$total_no_of_pages; ?>
                        </li>
                            
                        <li class="page-item sr-only" <?php if($page_no >= $total_no_of_pages){
                        echo "class='disabled'";
                        } ?>>
                            <a class="page-link" aria-label="Next" <?php if($page_no < $total_no_of_pages) {
                            echo "href='?page_no=$next_page'";
                            } ?>>Next</a>
                        </li>
                        
                        <?php if($page_no < $total_no_of_pages){
                        echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                        } ?>
                    </ul>
                </div>
                <!--end of pagination-->
                
                <hr>
                <div class="manage-class">
                    <form action="../includes/adminmanage.inc.php" method="post">
                        <button type="submit" name="deletear" class="btn btn-danger btn-lg btn-block">
                            Delete</button>
                        <input type="hidden" name="arId" id="arId">
                    </form>

                    <hr>
                    <a type="button" href="adminAddArticles.php" name="addar" class="btn btn-dark btn-lg float-right">
                        Add article</a>
                </div>

                <script>
                    //get cell value when there is an onclick event
                    var table = document.getElementById("articleTable");
                    if (table != null) {
                        if (table.rows[0] != null) {
                            table.rows[0].style.backgroundColor = "#202020";
                            table.rows[0].style.color = "#FFFFFF";
                        }
                        var flag = true;
                        for (var i = 1; i < table.rows.length; i++) {
                            table.rows[i].style.cursor = "pointer";
                            table.rows[i].onmouseenter = function () { this.style.backgroundColor = "#f47676"; this.style.color = "#FFFFFF"; };
                            table.rows[i].onmouseleave = function () { this.style.backgroundColor = ""; this.style.color = ""; };
                            table.rows[i].onclick = function () {
                                if(flag == true) {
                                    this.style.backgroundColor = "#d02537"; 
                                    this.style.color = "#FFFFFF"; 
                                    this.onmouseleave = null; 
                                    this.onmouseenter = null;
                                    var cell = this.cells[0].innerHTML;
                                    getVal(cell);
                                    flag = !flag; 
                                } else {
                                    this.style.backgroundColor = ""; 
                                    this.style.color = "";
                                    flag = !flag; 
                                }
                            };
                        }
                    }

                    function getVal(cell) {
                        document.getElementById("arId").value = cell;
                    }
                </script>

            </main>
            <!--end of main-->
        </div>
    </div>
    <!--end of wrapper-->

    <!--Cookies-->
    <?php
        include_once __DIR__.'/cookies.php';
    ?>

</body>
</html>
