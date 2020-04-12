<?php
session_start();
$status = "fail";
$data = "none";

if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && 
isset($_POST['inventory_id']) && !empty($_POST['inventory_id']) && 
isset($_POST['quantity']) && !empty($_POST['quantity'])){

    $inventory_id = $_POST['inventory_id'];
    $cart_id = 0;  //Database auto increment handle
    $user_id = $_SESSION['user']['user_id'];
    $quantity = $_POST['quantity'];
    
    require_once('db.php');
    $con = DBConnection();
    $sql = $con->prepare("INSERT INTO cart VALUES(?, ?, ?, ?)");
    $sql->bind_param("ssss", $cart_id, $user_id, $inventory_id, $quantity);
    if($sql->execute()){
        $status = "success";
    }else{
        $data = "Cannot insert into Database";
    }
}else{
    if(setcookie("cart", $_POST['inventory_id'])){
        $status = "success";
    }else{
        $data = "Cannot set cookie";
    }
    
}
echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );
?>