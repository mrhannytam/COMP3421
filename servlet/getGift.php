<?php
    $status = "fail";
    $data = "none";
    session_start();

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        require_once('db.php');
        $con = DBConnection();
        $sql = $con->prepare("SELECT * FROM gift");
        $sql->execute();
        $sql->bind_result($gift_id, $gift_name, $gift_image, $gift_point);
        $sql->store_result();
        if($sql->num_rows > 0){
            $data = array();
            $i = 0;
            while($sql->fetch()){
                $data[$i] = array(
                    'gift_id' => $gift_id,
                    'gift_name' => $gift_name,
                    'gift_image' => $gift_image,
                    'gift_point' => $gift_point
                );
                $i++;
            }
            $status = "success";
        }else{
            $data = "Your action has been reported";
        }
    }else{
        $data = "Haven't login";
    }

    echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );
?>