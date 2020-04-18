<html lang="en">
<head>
    <title>My Cart</title>
    <?php require("HEADER.php");?>
    <link rel="stylesheet" href="css/cart.css">
    <script src="./js/cart.js"></script>
</head>
<body>
    <?php include('nav.php');?>
    <div class="container">
        <h1>My Cart</h1>
    </div>
    <div class="container">
        <div id='table'>
            <!-- JAVASCRIPT HANDLE-->
        </div>
        <div id=button-group>
            <button class='clear btn btn-danger' id='clear'>Clear Cart</button>
            <button class='btn btn-success' id='checkout'>Chcek Out</button>
        </div>
        <div id="message">

        </div>
        <?php
            if(!isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
                echo "
                    <button id='login-register'>Login/Register</button>
                ";
            }
        ?>
    </div>
</body>
</html>