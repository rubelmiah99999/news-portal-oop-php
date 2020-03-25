<?php
include_once __DIR__.'/../database/commentsdb.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<form action="../includes/comments.inc.php" method="post" name="commentForm" onsubmit="emptyComment()">
    <div class="form-group">
        <span>Add a comment</span>
            <button class="btn btn-dark" type="submit" name="comment">
                Comment
            </button>
        <textarea class="form-control" rows="3" name="comment" id="commentArea" placeholder="..."></textarea>
    </div>
</form>

<div id="comment-div"></div>


<div class="comment-div">
    <?php

    $comm = new Comments();
    $idArticle = $_SESSION['idArticle'];
    $comments = $comm->fetchComments($idArticle);

    if($comments && !empty($comments)) {
        foreach($comments as $key => $comment) {
            echo '<div class="card">';
                echo '<div class="card-body">';
                    echo '<h6 class="card-header">'.stripslashes($comment['username']).'</h6>';
                    echo '<p class="card-text">'.stripslashes($comment['content']).'</p>';
                echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>

<script>
    function emptyComment() {
        document.getElementById("commentArea").innerText = "";
    }
</script>
