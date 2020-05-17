<?php
$status = "fail";
$data = "none";
session_start();

if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id']) && isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])){
    $user_id = $_SESSION['user']['user_id'];
    //UPLOAD IMAGE
    $upload_directory = '../image/';
    $file_name = $user_id . "." . basename($_FILES['profile_image']['type']);
    $upload_file = $upload_directory . $file_name;

    if(strcmp(basename($_FILES['profile_image']['type']),"jpeg") == 0 || 
        strcmp(basename($_FILES['profile_image']['type']),"gif") == 0 ||
        strcmp(basename($_FILES['profile_image']['type']),"jpg") == 0 ||
        strcmp(basename($_FILES['profile_image']['type']),"png") == 0){
        if(!move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_file)){
            $data = "Cannot upload profile image"; 
        }
            //INSERT INTO DATABASE
        require_once('db.php');
        $con = DBConnection();

        $sql = $con->prepare("UPDATE user SET profile_image = ? WHERE user_id = ?");
        $sql->bind_param("ss", $upload_file, $user_id);
        if($sql->execute()){
            $status = "success";
        }else{
            $data = "Cannot insert into table user";
        }
    }else{
        $data = "Wrong file extension";
    }  
}else{
    $data = "Image Cannot Empty";
}

echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);