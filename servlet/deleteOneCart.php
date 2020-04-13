<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && isset($_POST['inventory_id']) && !empty($_POST['inventory_id'])){
        require_once('db.php');
        $con = DBConnection();

        $user_id = $_SESSION['user']['user_id'];
        $inventory_id = $_POST['inventory_id'];

        $sql = $con->prepare("DELETE FROM cart WHERE user_id = ? AND inventory_id = ?");
        $sql->bind_param("ss", $user_id, $inventory_id);
        if($sql->execute()){
            $status = "success";
        }else{
            $data = "Cannot delete from table cart";
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