<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
        $user_id = $_SESSION['user']['user_id'];
        require_once('db.php');
        $con = DBConnection();
        $sql = $con->prepare("DELETE FROM cart WHERE user_id = ?");
        $sql->bind_param("s", $user_id);
        if($sql->execute()){
            $status = "success";
        }else{
            $data = "Cannot delete record in table cart";
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