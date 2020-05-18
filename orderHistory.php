<?php
session_start();
if(!isset($_SESSION['user']['user_id']) && empty($_SESSION['user']['user_id'])){
    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <?php require_once('HEADER.php')?>
    <title>Order History</title>
    <script src="./js/orderHistory.js"></script>
    <link rel="stylesheet" href="css/order_history.css">
</head>
<body>
<?php include('nav.php');?>
    <div class="container">
        <h1>Order History</h1>
    </div>
    <div class="container" id="order-history">
        <!-- JS HANDLE -->  
    </div>
    <div class="message">
        <!-- JS HANDLE -->
    </div>
</body>
</html>