<?php
session_start();
if(!isset($_SESSION['user']['user_id']) && empty($_SESSION['user']['user_id'])){
    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <?php require_once('HEADER.php')?>
    <title>Reward</title>
    <script src="./js/reward.js"></script>
    <link rel="stylesheet" href="css/reward.css">
</head>
<body>
    <?php include('nav.php');?>
    <div class="container">
        <h1>Reward Gift</h1>
        <div>
            You have: 
            <h3 id='points'>
                <!-- JS HANDLE -->
            </h3>
        </div>
        <div class="own_gift">
            <h3>My Gift</h3>
            <!-- JS HANDLE -->
        </div>
        <hr>
        <div>
            <h3>Available Gifts</h3>
            <!-- JS HANDLE -->
            <div id="gifts">

            </div>
        </div>
        
        <div class="message">
            <!-- JS HANDLE -->
        </div>
    </div>
</body>
</html>