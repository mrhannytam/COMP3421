<?php
$status = "fail";
$data = "none";
session_start();

if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) 
&& isset($_POST['score']) && !empty($_POST['score'])
&& isset($_POST['comment']) && !empty($_POST['comment'])
&& isset($_POST['comment_id']) && !empty($_POST['comment_id'])){
    require_once('db.php');
    $con = DBConnection();

    $comment_id = htmlspecialchars(urlencode($_POST['comment_id']));
    $score = htmlspecialchars(urlencode($_POST['score'])); //CHECKING
    $comment = htmlspecialchars($_POST['comment']); //CHECKING
    $user_id = $_SESSION['user']['user_id'];

    if($score <= 0) $score = 0; else $score = 5;

    $sql = $con->prepare("UPDATE comment set score = ?, comment = ?, comment_time = current_timestamp() WHERE user_id = ? AND comment_id=?");
    $sql->bind_param("ssss", $score, $comment, $user_id, $comment_id);
    if($sql->execute()){
        $status = "success";
    }else{
        $data = "Cannot insert into table comment";
    }
}else{
    $data = "Please leave a comment :)";
}

echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);