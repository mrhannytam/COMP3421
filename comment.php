<?php
session_start();
if(!isset($_SESSION['user']['user_id']) && empty($_SESSION['user']['user_id'])){
    header("Location: index.php");
}
else if(isset($_GET['comment_id']) && !empty($_GET['comment_id'])){
    $user_id = $_SESSION['user']['user_id'];
    $comment_id = $_GET['comment_id'];
    require_once('servlet/db.php');
    $con = DBConnection();
    $sql = $con->prepare("SELECT comment FROM comment WHERE comment_id = ? AND user_id = ?");
    $sql->bind_param("ss", $comment_id, $user_id);
    $sql->execute();
    $sql->bind_result($comment);
    $sql->fetch();
    if($sql-> num_rows < 0){
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <?php require_once('HEADER.php')?>
    <script src="./js/comment.js"></script>
    <title>Comment Page</title>
</head>
<body>
    <?php include('nav.php');?>
    <div class="container">
        <h1>Comment</h1>
        <div class="image">
            <!-- JS HANDLE -->
        </div>
        <div class="comment_time">
            <!-- JS HANDLE -->
        </div>
        <div class="star">
            <!-- JS HANDLE -->
        </div>
        <div class="comment_form_area">
            <form id="comment_form">
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                <input class="btn btn-danger" type="reset" value="Clear">
                <input class="btn btn-success" type="submit" value="Submit">
            </form>
        </div>
        <div id="message">
            <!-- JS HANDLE -->
        </div>
    </div>
</body>
</html>