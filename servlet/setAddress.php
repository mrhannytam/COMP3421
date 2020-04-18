<?php
$status = "fail";
$data = "none";
session_start();

if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && isset($_POST['address']) && !empty($_POST['address'])){
    require_once('db.php');
    $con = DBConnection();

    $user_id = $_SESSION['user']['user_id'];
    $address = $_POST['address'];
    $sql = $con->prepare("UPDATE user set address = ? WHERE user_id = ?");
    $sql->bind_param("ss", $address, $user_id);
    if($sql->execute()){
        $status = "success";
    }else{
        $data = "Cannot insert into table user";
    }
}else{
    $data = "Address Cannot Empty";
}

echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);