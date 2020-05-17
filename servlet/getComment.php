<?php
    $status = "fail";
    $data = "none";
   
    if(isset($_POST['inventory_id']) && !empty($_POST['inventory_id'])){
        require_once('db.php');
        $con = DBConnection();
        $inventory_id = htmlspecialchars(urlencode($_POST['inventory_id']));    
    
        $sql = $con->prepare("SELECT user_id, comment, score, comment_time FROM comment WHERE inventory_id = ? AND comment IS NOT NULL ORDER BY comment_time DESC");
        $sql->bind_param("s", $inventory_id);
        $sql->execute();
        $sql->bind_result($user_id, $comment, $score, $comment_time);
        $sql->store_result();
        if($sql->num_rows > 0){
            $i = 0;
            $data = array();
            while($sql->fetch()){
                $data[$i] = array(
                    'user_id' => $user_id,
                    'comment' => $comment,
                    'score' => $score,
                    'comment_time' => $comment_time
                );
                $i++;
            }
            $status = "success";
        }else{
            $data = "no comment yet";
        }
    }else{
        $data = "Cannot search null";
    }

    echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );
?>