<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <?php require("HEADER.php")?>
    <script src="js/registration.js"></script>
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
<?php 
require_once('nav.php');
if(isset($_SESSION['user']['user_id'])){
    header('Location: index.php');
}
?>
    <div class="container">
        <h1>Registration Form</h1>
        <form>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="username" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Passord</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password2">Confirmed Password</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm password">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
         <label for="profile_image">Profile Image</label>
            Profile Image: <input type="file" name="profile_image" id="profile_image">
        </div>
        <!-- <div class="checkbox">
            <label>
                <input type="checkbox" id="promotion"> agree for promotion
            </label>
        </div> -->
        <div>
            <input type="reset" value="reset">
            <input type="submit" value="submit">   
        </div>
        </form>
        <button class="btn btn-default" id="back">Back</button>
    </div>
</body>
</html>