<?php
$status = "fail";
$data = "none";

if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
    //CHECKING
    $user_id = htmlspecialchars(urlencode($_POST['username']));
    $password = htmlspecialchars(urlencode($_POST['password']));

    //Connect to Database
    require_once('db.php');
    $con = DBConnection();

    $sql = $con->prepare("SELECT salt, hash , active FROM user WHERE user_id = ?");
    $sql->bind_param("s", $user_id);
    $sql->execute();
    $sql->bind_result($salt, $hash, $active);
    $sql->store_result();
    if($sql->num_rows > 0){
        $sql->fetch();
        $password = hash("SHA512", $password);
        $password = hash("SHA512", $password . $salt);
        if($active === "YES"){
            if($password === $hash){
                $status = "success";
                session_start();
                $_SESSION['user']['user_id'] = $user_id;
            }else{
                $data = "Wrong Password";
            }
        }else{
            $data = "Account haven't verified";
        }
    }else{
        $data = "Username does not exist";
    }
}else{
    $data = "Username and Password cannot empty";
}

echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);
?>