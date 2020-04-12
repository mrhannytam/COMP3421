<?php
if(isset($_GET['key']) && !empty($_GET['key'])){
    $key = $_GET['key'];
    require_once('db.php');
    $con = DBConnection();
    $sql = $con->prepare("SELECT hash, active FROM user WHERE hash = ?");
    $sql->bind_param("s", $key);
    $sql->execute();
    $sql->bind_result($hash, $active);
    $sql->store_result();
    if($sql->num_rows > 0){
        $sql->fetch();
        if($active === "YES"){
            echo "Your account has been verified";
        }else{
            if($hash === $key){
                $sql = $con->prepare("UPDATE user SET active = 'YES' WHERE hash = ?");
                $sql->bind_param("s", $hash);
                if($sql->execute()){
                    echo "Verify success";
                }
            }else{
                echo "Your action has been reported";
                //Security report
            }
        }
    }else{
        echo "Your action has been reported";
        //Security report
    }
}else{
    echo "Your action has been reported";
        //Security report
}
?>