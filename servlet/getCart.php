<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        require_once('db.php');
        require_once('servlet/db.php');
        $user_id = $_SESSION['user']['user_id'];
        $con = DBConnection();
        $sql = $con->prepare("SELECT inventory_id, quantity FROM cart WHERE user_id = ?");
        $sql->bind_param("s", $user_id);
        $sql->execute();
        $sql->bind_result($user);
        $sql->store_reuslt($inventory_id, $quantity);
        if($sql->num_rows > 0){
            while($sql->fetch()){
                $data = json_encode(
                        array(
                            'inventory': $inventory_id,
                            'quantity': $quantity
                        )
                    );
                    echo $data;
            }
        }
    }else{
        //NOTHING
    }

    echo json_encode(
        array(
            'status'=>$status,
            'data'=>$data
        )
    );
?>