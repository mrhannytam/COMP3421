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
        <table>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <button class="clear-cart">Clear Cart</button>
        <?php
            // if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
            //     require_once('servlet/db.php');
            //     $con = DBConnection();
            //     $sql = $con->prepare("SELECT * FROM ");
            //     $sql->bind_param();
            //     $sql->execute();
            //     $sql->bind_result();
            //     $sql->store_reuslt();
            //     if($sql->num_rows > 0){
            //         while($sql->fetch()){

            //         }
            //     }else{
            //         echo "
            //             <button id='shopping'>Go to Shopping!</button>
            //         ";
            //     }
            // }else{
            //     echo "LATER DO LA"; 
            // }
        ?>
        <?php
            if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
                echo "
                    <button id='checkout'>Chcek Out</button>
                ";
            }else{
                echo "
                    <button id='login-register'>Login/Register</button>
                ";
            }
        ?>
    </div>
</body>
</html>