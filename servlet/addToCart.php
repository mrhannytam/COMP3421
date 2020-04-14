<?php
session_start();
$status = "fail";
$data = "none";

if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) 
&& isset($_POST['inventory_id']) && !empty($_POST['inventory_id']) 
&& isset($_POST['quantity']) && !empty($_POST['quantity'])){

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
}else if(!isset($_COOKIE["cart"]) && !isset($_COOKIE["quantity"])){ //SET user cookie if cookie not exist
    if(setcookie("cart", $_POST['inventory_id']) && setcookie("quantity", $_POST['quantity'])){ //NEED Security checking
        $status = "success";
    }else{
        $data = "Cannot set cookie";
    } 
}else{
    $original_cart = $_COOKIE["cart"];
    $original_quantity = $_COOKIE["quantity"];
    $new_cart = $original_cart . ',' . $_POST['inventory_id']; // Security cehcking
    $new_quantity = $original_quantity . ',' . $_POST['quantity'];
    if(setcookie("cart", $new_cart) && setcookie("quantity", $new_quantity)){
        //cart: 1,2
        //quantity: 2,3
        //Add inventory 1 with 2 amount
        //Add inventory 2 with 3 amount
        $status = "success";
        $data = array(
            'cart' => $new_cart,
            'quantity' => $new_quantity
        );
    }else{
        $data = "Cannot set new cookie";
    }
    
}
echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );
?>