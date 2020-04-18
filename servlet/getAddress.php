<?php
$status = "fail";
$data = "none";
session_start();

if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
    require_once('db.php');
    $con = DBConnection();

    $user_id = $_SESSION['user']['user_id'];
    $sql = $con->prepare("SELECT address FROM user WHERE user_id = ?");
    $sql->bind_param("s", $user_id);
    $sql->execute();
    $sql->bind_result($address);
    $sql->store_result();
    $sql->fetch();
    if($sql->num_rows > 0 && !empty($address)){
        $status = "success";
        $data = $address;
    }


}else{
    $data = "Haven't lpgin";
}


echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);