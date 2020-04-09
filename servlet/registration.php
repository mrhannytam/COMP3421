<?php
$status = "fail";
$data = "none";

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
    //Connect to database
    require_once('db.php');
    $con = DBConnection();

    //Checking
    require_once('regex.php');
    $username = checkUsername($_POST['username']);
    $password = checkPassword($_POST['password']);
    $email = checkEmail($_POST['email']);
    $profile_image = $_FILES['profile_image']['name'];
    $address = null;
    $reward_balance = 0;
    $active = "NO";

    //salt and hash
    $salt = rand();
    $password = hash("SHA512", $password);
    $password = hash("SHA512", $password . $salt);

    //Prepare SQL statement
    $sql = $con -> prepare("INSERT INTO user VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssss", $username, $salt, $password, $email, $active, $address, $profile_image, $reward_balance);
    if($sql->execute()){ 
        //PHP Mailer for email verify
    
        $status = "success";
    }else{
        $data = "Cannot insert into DB" . $username . $password . $email . $profile_image . $promotion;
    }

}else{
    $data = "Some field is empty";
}

echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);
?>