<?php
session_start();
if(isset($_SESSION['user'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <?php require("HEADER.php")?>
    <script src="js/login.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php include('nav.html');?>
    <div class="container">
        <h1>Login Page</h1>
        <form>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            <div>
                <button class="btn btn-default">Submit</button>
                <a href="registration.php">Sign up</a>
            </div>
        </form>
    </div>
</body>
</html>