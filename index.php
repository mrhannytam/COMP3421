<html lang="en">
<head>
    <title>Document</title>
    <?php require("HEADER.php");?>
    <script src="./js/index.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include('nav.php');?>
    <?php 
        if(isset($_SESSION['user'])){
            echo "<div class='banner'>" . "Welcome, " . $_SESSION['user']['user_id'] . "</div>";
        }
    ?>
    <div class="container-fluid">
        <div id="message">
            <!-- JS HANDLE -->
        </div>
        <div id="server_inventory">
            <!-- JS HANDLE -->
        </div>
    </div>
</body>
</html>