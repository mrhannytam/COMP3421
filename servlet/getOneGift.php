<?php
    $status = "fail";
    $data = "none";
    session_start();

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && isset($_POST['exchange_id']) && !empty($_POST['exchange_id'])){
        require_once('db.php');
        $con = DBConnection();
        $exchange_id = htmlspecialchars(urlencode($_POST['exchange_id']));

        $sql = $con->prepare('SELECT gift_name, gift_points FROM gift WHERE gift_id = ?');
        $sql->bind_param("s", $exchange_id);
        $sql->execute();
        $sql->bind_result($gift_name, $gift_point);
        $sql->store_result();
        $sql->fetch();
        if($sql->num_rows > 0){
            $status = "success";
            $data = array(
                'gift_name' => $gift_name,
                'gift_point' => $gift_point
            );
        }else{
            $data = "Your action has been reported";
        }

    }else{
        $data = "Exchange ID cannot be empty";
    }

    echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );

?>