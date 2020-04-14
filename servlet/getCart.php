<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        require_once('db.php');
        $user_id = $_SESSION['user']['user_id'];
        $con = DBConnection();
        $sql = $con->prepare("SELECT cart.inventory_id, inventory_name, quantity, price FROM cart, inventory WHERE cart.inventory_id = inventory.inventory_id AND user_id = ? ORDER BY cart.cart_id DESC");
        $sql->bind_param("s", $user_id);
        $sql->execute();
        $sql->bind_result($inventory_id, $inventory_name, $quantity, $price);
        $sql->store_result();
        if($sql->num_rows > 0){
            $data = array();
            $i = 0;
            while($sql->fetch()){  
                $data[$i] = array(
                    "inventory_id" => $inventory_id,
                    "inventory_name"=> $inventory_name,
                    "quantity"=> $quantity,
                    "price"=> $price,
                    "total"=> $quantity * $price
                );
                $i++;
            }
            $status = "success";
        }else{
            $data = "Nothing added to cart";
        }
    }else{
        if(isset($_COOKIE['cart']) && isset($_COOKIE['quantity'])){ //Need security checking
            $inventory_id = explode(",", $_COOKIE['cart']);
            $quantity = explode(",", $_COOKIE['quantity']);
            require_once('db.php');
            $con = DBConnection();
            $data = array();
            for($i = 0; $i < sizeOf($inventory_id); $i++){
                $sql = $con->prepare("SELECT inventory_name, price FROM inventory WHERE inventory_id = ?");
                $sql->bind_param("s", $inventory_id[$i]);
                $sql->execute();
                $sql->store_result();
                $sql->bind_result($inventory_name, $price);
                $sql->fetch(); 
                $data[$i] = array(
                    'inventory_id' => $inventory_id[$i],
                    'inventory_name' => $inventory_name,
                    'quantity' => $quantity[$i],
                    'price' => $price,
                    'total' => $price * $quantity[$i]
                );
            }
            $status = "success";
        }else{
            $data = "Nothing added to cart";
        }
    }

    echo json_encode(
        array(
            'status'=>$status,
            'data'=>$data
        )
    );
?>