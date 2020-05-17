<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        $purchase_id = 0; //Left for DB handle
        $comment_id = 0; //Left for DB handle
        $score = 0;
        $user_id = $_SESSION['user']['user_id'];
        $deliver = "NO";
        $purchase_time = time();    
        if(isset($_POST['coupon']) && !empty($_POST['coupon'])) $coupon_id = htmlspecialchars(urlencode($_POST['coupon']));

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
                    }

                    $sql = $con->prepare("INSERT INTO comment VALUES(?, ?, ?, NULL, NULL, NULL)"); //INSERT into table comment
                    $sql->bind_param("sss", $comment_id, $user_id, $inventory_id);
                    if(!$sql->execute()){
                        $data = "Cannot insert into comment";
                        break;
                    }
                    
                    $sql = $con->prepare("UPDATE user SET reward_balance = reward_balance + ((SELECT price FROM inventory WHERE inventory_id = ?) * ?)"); //UPDATE reward balance
                    $sql->bind_param("ss", $inventory_id, $quantity);
                    if(!$sql->execute()){
                        $data = "Cannot update reward balance";
                        break;
                    }else{
                        $status = "success";
                    }
                }else{
                    $data = "Cannot insert into table purchase";
                    break;
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