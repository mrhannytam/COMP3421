<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        require_once('db.php');
        $con = DBConnection();

        $user_id = $_SESSION['user']['user_id'];

        $sql = $con->prepare("SELECT purchase_id, inventory_id, quantity, deliver, purchase_time FROM purchase WHERE user_id = ? ORDER BY purchase_time DESC");
        $sql->bind_param("s", $user_id);
        $sql->execute();
        $sql->bind_result($purchase_id, $inventory_id, $quantity, $deliver, $purchase_time);
        $sql->store_result();
        if($sql->num_rows > 0){
            $data = array();
            $i = 0;
            while($sql->fetch()){
                $data[$i] = array(
                    'purchase_id' => $purchase_id,
                    'inventory_id' => $inventory_id,
                    'quantity' => $quantity,
                    'deliver' => $deliver,
                    'purchase_time' => $purchase_time
                );
                $i++;
            }
            $status = "success";
        }else{
            $data = "Do not have any purchase item";
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