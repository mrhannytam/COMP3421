<?php
session_start();
if(!isset($_SESSION['user']['user_id']) && empty($_SESSION['user']['user_id'])){
    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <?php require_once('HEADER.php')?>
    <title>Account Setting</title>
    <script src="./js/accountSetting.js"></script>
</head>
<body>
<?php include('nav.php');?>
    <div class="container">
        <h1>Account Setting</h1>
    </div>
    <div class="container">
        <h2>Profile Image</h2>
        <img src="" alt="" width=100 height=auto id="profile_image">
        <form id="image_form">
            <input type="file" name="profile_image" id="upload_image">
            <input class="btn btn-light" type="submit" value="Submit">
        </form>
    </div>

    <div class="container">
        <h2>Address Setting</h2>
        <div>
            <form id="address_form">
                <textarea rows="6" cols="50" name="address" id="address"></textarea><br>
                <input class="btn btn-danger" type="reset" value="Ckear">
                <input class="btn btn-success" type="submit" value="Submit">
            </form>
        </div>
    </div>
    <div class="container" id="message">
    
    </div>
</body>
</html>