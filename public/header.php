<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Nowena</a>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Join Us
                    </a>
                    <!--in drop down Join Us-->
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <?php

                            if(isset($_SESSION['userUsername']) || isset($_SESSION['administratorUsername'])) {
                                echo '<a class="dropdown-item" href="../includes/logout.inc.php">Log out</a>';
                            } else {
                                echo '<a class="dropdown-item" href="loginuser.php">Log in as User</a>';
                                echo '<a class="dropdown-item" href="loginadministrator.php">Log in as Administrator</a>';
                                echo '<div class="dropdown-divider"></div>';
                                echo '<a class="dropdown-item" href="signup.php">Sign Up</a>';
                            }

                        ?>

                    </div>
                </li>
            </ul>
            <!--search form-->
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <ul class="navbar-nav  ml-auto">
                
                    <?php

                        if(isset($_SESSION['userUsername'])) {
                            $userUsername = $_SESSION['userUsername'];
                            echo '<li class="nav-item active white-font">'.$userUsername.'</li>';
                        } else if(isset($_SESSION['administratorUsername'])) {
                            $administratorUsername = $_SESSION['administratorUsername'];
                            echo '<li class="nav-item active btn btn-success"><a href="adminManageArticles.php">Manage</a></li>';
                            echo '<li class="nav-item active white-font my-auto mx-1">'.$administratorUsername.'</li>';
                        } else {
                            echo '<li class="nav-item active white-font"></li>';
                        }

                    ?>
                
            </ul>  
    </nav>

    <div class="jumbotron jumbotron-fluid jumbotron-header mb-0">
        <div class="container">
            <h2 class="display-4 text-center">Nowena News</h2>
        </div>
    </div>

    <script>
        //navbar brand animation
        document.getElementsByClassName("navbar-brand")[0].addEventListener('mouseover', function(){
            document.getElementsByClassName("navbar-brand")[0].classList.add('flip-brand');
            window.setTimeout(function(){
                document.getElementsByClassName("navbar-brand")[0].classList.remove('flip-brand')
            }, 500);
        });
    </script>
