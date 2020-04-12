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
    $address = null;
    $reward_balance = 0;
    $active = "NO";
    $upload_file = "../image/default.png";

    //Upload image to server
    if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])){
        $upload_directory = '../image/';
        $file_name = $username . basename($_FILES['profile_image']['name']);
        $upload_file = $upload_directory . $file_name;
        if(!move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_file)){
            $data = "Cannot upload profile image"; 
        }
    }

    //salt and hash
    $salt = rand();
    $password = hash("SHA512", $password);
    $password = hash("SHA512", $password . $salt);

    //Prepare SQL statement
    $sql = $con -> prepare("INSERT INTO user VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssss", $username, $salt, $password, $email, $active, $address, $upload_file, $reward_balance);
    if($sql->execute()){ 
        //PHP Mailer for email verify
        require_once('../PHPMailer/PHPMailer.php');
        require_once('../PHPMailer/SMTP.php');  
        require_once('../PHPMailer/OAuth.php');
        require_once('../PHPMailer/Exception.php');

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "petlatocomp3421@gmail.com";
        $mail->Password = "Petlato`12";
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->isHTML(true);
        $mail->setFrom("petlatocomp3421@gmail.com", "Pet Shop");
        $mail->addAddress($email);
        $mail->Subject = "[Email Verification] Petlato New User";
        $mail->Body = "Please click this link to verify your account.\n" . 
        "<a href='http://localhost/petlato/servlet/emailVerify.php?key=$password'>Click Here </a>";
        if($mail->send()){
            $status = "success";
        }else{
            $data = "Cannot send verify email";
        }
        
    }else{
        $data = "Username has been taken";
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