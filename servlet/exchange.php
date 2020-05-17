<?php
    $status = "fail";
    $data = "none";
    session_start();

    if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && isset($_POST['exchange_id']) && !empty($_POST['exchange_id'])){
        $user_id = $_SESSION['user']['user_id'];
        $exchange_id = htmlspecialchars(urlencode($_POST['exchange_id']));
        require_once('db.php');
        $con = DBConnection();

        $sql = $con->prepare("SELECT reward_balance, gift_points FROM user, gift WHERE user_id = ? && gift_id = ?");
        $sql->bind_param("ss", $user_id, $exchange_id);
        $sql->execute();
        $sql->bind_result($balance, $gift_points);
        $sql->store_result();
        $sql->fetch();
        if($sql->num_rows > 0){
            if($balance >= $gift_points){
                $newBalance = $balance - $gift_points;
                $sql = $con->prepare('UPDATE user SET reward_balance = ? WHERE user_id = ?');
                $sql->bind_param("is", $newBalance ,$user_id);
                if($sql->execute()){
                    $sql = $con->prepare('INSERT INTO exchange VALUES(0, ?, ?, "NO")');
                    $sql->bind_param("ss", $user_id, $exchange_id);
                    if($sql->execute()){
                        $status = "success";
                    }else{
                        $data = "Cannot insert into exchange";
                    }
                }else{
                    $data = "Cannot update reward_balance";
                }
            }else{
                $data = "Not enough points";
            }
        }else{
            $data = "Your action has been reported";
        }

        
        

    }else{
        $data = "Nothing exchange" . $_POST['exchange_id'];
    }

    echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );

?>