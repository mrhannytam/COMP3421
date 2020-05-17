<?php
    session_start();
    $status = "fail";
    $data = "none";

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && isset($_POST['comment_id']) && !empty($_POST['comment_id'])){
        require_once('db.php');
        $con = DBConnection();

        $user_id = $_SESSION['user']['user_id'];
        $comment_id = htmlspecialchars(urlencode($_POST['comment_id']));

        $sql = $con->prepare("SELECT inventory.inventory_id, inventory_image, comment, score, comment_time FROM inventory, comment 
                              WHERE inventory.inventory_id = (SELECT inventory_id FROM comment WHERE comment_id = ? AND user_id = ?)
                              AND comment_id = ? AND user_id = ?");
        $sql->bind_param("ssss", $comment_id, $user_id, $comment_id, $user_id);
        $sql->execute();
        $sql->bind_result($inventory_id, $inventory_image, $comment, $score, $comment_time);
        $sql->store_result();
        $sql->fetch();
        if($sql->num_rows > 0){
            if($comment == null) $comment = "Have not comment yet";
            $data = array(
                'inventory_id' => $inventory_id,
                'inventory_image' => $inventory_image,
                'comment' => $comment,
                'score' => $score,
                'comment_time' => $comment_time
            );   
            $status = "success";    
        }else{
            $data = 'You should not be here';
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