<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        $purchase_id = 0; //Left for DB handle
        $user_id = $_SESSION['user']['user_id'];
        $deliver = "NO";
        $purchase_time = time();    


        require_once('db.php');
        $con = DBConnection();
        $query = $con->prepare("SELECT inventory_id, quantity FROM cart WHERE user_id = ?"); //GET user cart
        $query->bind_param("s", $user_id);
        $query->execute();
        $query->bind_result($inventory_id, $quantity);
        $query->store_result();
        if($query->num_rows > 0){
            while($query->fetch()){
                $sql = $con->prepare("INSERT INTO purchase VALUES(?, ?, ?, ?, ?, current_time())"); //INSERT into table purchase
                $sql->bind_param("sssss", $purchase_id, $user_id, $inventory_id, $quantity, $deliver);
                if($sql->execute()){
                    $sql = $con->prepare("DELETE FROM cart WHERE user_id = ?"); //DELETE record in cart if purchase success
                    $sql->bind_param("s", $user_id);
                    if(!$sql->execute()){
                        $data = "Cannot delete recod in cart";
                    break;
                    }else{
                        $status = "success";
                    }
                }else{
                    $data = "Cannot insert into table purchase";
                }
            }
            
        }else{
            $data = "No inventory in your cart";
        }
    }else{
        $data = "Haven't login";
    }

    echo json_encode(
        array(
            "status"=> $status,
            "data"=> $data
        )
    );
?>