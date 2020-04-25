<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        require_once('db.php');
        $user_id = $_SESSION['user']['user_id'];
        $con = DBConnection();
        $sql = $con->prepare("SELECT gift_name, gift_image, COUNT(*) FROM exchange, gift WHERE exchange.gift_id = gift.gift_id AND user_id = ? AND use_or_not = 'NO' GROUP BY gift_name ORDER BY gift_name");
        $sql->bind_param("s", $user_id);
        $sql->execute();
        $sql->bind_result($gift_name, $gift_image, $quantity);
        $sql->store_result();
        if($sql->num_rows > 0){
            $data = array();
            $i = 0;
            while($sql->fetch()){  
                $data[$i] = array(
                    "gift_name" => $gift_name,
                    "gift_image"=> $gift_image,
                    "quantity"=> $quantity
                );
                $i++;
            }
            $status = "success";
        }else{
            $data = "No reward gifts";
        }
    }else{
        $data = "Haven't login";
    }

    echo json_encode(
        array(
            'status'=>$status,
            'data'=>$data
        )
    );
?>