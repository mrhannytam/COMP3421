<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        require_once('db.php');
        $user_id = $_SESSION['user']['user_id'];
        $con = DBConnection();
        $sql = $con->prepare("SELECT cart.inventory_id, quantity, price FROM cart, inventory WHERE cart.inventory_id = inventory.inventory_id AND user_id = ? ORDER BY cart.cart_id DESC");
        $sql->bind_param("s", $user_id);
        $sql->execute();
        $sql->bind_result($inventory_id, $quantity, $price);
        $sql->store_result();
        if($sql->num_rows > 0){
            $data = array();
            $i = 0;
            while($sql->fetch()){  
                $data[$i] = array(
                    "inventory_id"=> $inventory_id,
                    "quantity"=> $quantity,
                    "price"=> $price,
                    "total"=> $quantity * $price
                );
                $i++;
            }
            $status = "success";
        }else{
            $data = "Haven't add to cart";
        }
    }else{
        $data = "Haven't register";
    }

    echo json_encode(
        array(
            'status'=>$status,
            'data'=>$data
        )
    );
?>