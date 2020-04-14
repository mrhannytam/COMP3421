<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) 
    && isset($_POST['inventory_id']) && !empty($_POST['inventory_id'])){
        require_once('db.php');
        $con = DBConnection();

        $user_id = $_SESSION['user']['user_id'];
        $inventory_id = $_POST['inventory_id'];

        $sql = $con->prepare("DELETE FROM cart WHERE user_id = ? AND inventory_id = ?");
        $sql->bind_param("ss", $user_id, $inventory_id);
        if($sql->execute()){
            $status = "success";
        }else{
            $data = "Cannot delete from table cart";
        }
    }else if(isset($_COOKIE['cart']) && isset($_COOKIE['quantity'])){
        $inventory_id = explode(",", $_COOKIE['cart']);
        $quantity = explode(",", $_COOKIE['quantity']);
        $delete_id = $_POST['inventory_id'];
        $key = array_search($delete_id, $inventory_id);
        unset($inventory_id[$key]);
        unset($quantity[$key]);
        $new_cart = implode(",", $inventory_id);
        $new_quantity = implode(",", $quantity);
        if(setcookie("cart", $new_cart) && setcookie("quantity", $new_quantity)){
            $status = "success";
        }else{
            $data = "Cannot set cookie";
        }

    }else{
        $data = "Your action has been reported";
    }

    echo json_encode(
        array(
            "status"=> $status,
            "data"=> $data
        )
    );
?>