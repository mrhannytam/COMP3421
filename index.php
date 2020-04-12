<html lang="en">
<head>
    <title>Document</title>
    <?php require("HEADER.php");?>
    <script src="./js/index.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php include('nav.php');?>
    <div class="container-fluid" style="padding-top: 50px;">
        WELCOME 
        <?php 
        if(isset($_SESSION['user'])){
            echo " " . $_SESSION['user']['user_id'];
        }
        ?>
    </div>
    <div class="container-fluid">
        <?php
            require_once('servlet/db.php');
            $con = DBConnection();
            $sql = $con->prepare("SELECT * FROM inventory");
            $sql->execute();
            $sql->bind_result($inventory_id, $inventory_name, $inventory_image, $price);
            $sql->store_result();
            if($sql->num_rows > 0){
                while($sql->fetch()){
                    echo "
                    <div class='inventory'>
                        <div>
                            <a href='./inventory.php?inventory_id={$inventory_id}'><img src='{$inventory_image}'  width=100 height=100></a>
                        </div>
                        <div>
                            <div class='name'>
                                {$inventory_name}
                            </div>
                            <div class='price'>
                                {$price}
                            </div>
                        </div>
                    </div>
                    ";
                }
            }else{
                echo "<h1>" . "Shop has not open yet" . "</h1>";
            }
        ?>
    </div>
</body>
</html>