<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        $user_id = $_SESSION['user']['user_id'];
        require_once('db.php');
        $con = DBConnection();
        $sql = $con->prepare('SELECT reward_balance FROM user WHERE user_id = ?');
        $sql->bind_param("s", $user_id);
        $sql->execute();
        $sql->store_result();
        $sql->bind_result($points);
        $sql->fetch();
        if($sql->num_rows > 0){
            $status = "success";
            $data = $points;
        }else{
            $data = "your action has been reported";
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