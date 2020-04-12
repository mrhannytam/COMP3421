<html lang="en">
<head>
    <title>Inventory</title>
    <?php require_once('HEADER.php');?>
    <link rel="stylesheet" href="./css/inventory.css">
    <script src="./js/inventory.js"></script>
</head>
<body>
    <?php require_once('nav.php');?>
    <div class="container" style="padding-top: 50px;">
        <?php
            if(isset($_GET['inventory_id']) && !empty($_GET['inventory_id'])){
                $inventory_id = $_GET['inventory_id'];
                require_once('servlet/db.php');
                $con = DBConnection();
                $sql = $con->prepare("SELECT inventory_name, inventory_image, price FROM inventory WHERE inventory_id = ?");
                $sql->bind_param("s", $inventory_id);
                $sql->execute();
                $sql->bind_result($inventory_name, $inventory_image, $price);
                $sql->store_result();
                if($sql->num_rows > 0){
                    $sql->fetch();
                    //OK
                    echo "<h1>" . $inventory_name . "</h1>";
                    echo "<img src='" . $inventory_image . "' class='img-thumbnail inventory'>";
                    echo "<h2>$" . $price . "</h2>";
                    echo "<input type='number' name='quantity' id='quantity' placeholder='Quantity' value='1'>";
                    echo "<button class='add-to-cart' id='" . $inventory_id . "'>Add to Cart</button>";
                }else{
                    echo "Your action has been reported";
                    //Report possible attack
                }
            }
        ?>
    </div>
    <div class="container">
        <div id="comment">
            <h1>Comment</h1>
            <?php
                if(isset($_GET['inventory_id']) && !empty($_GET['inventory_id'])){
                    $inventory_id = $_GET['inventory_id'];
                    require_once('servlet/db.php');
                    $con = DBConnection();
                    $sql = $con->prepare("SELECT user_id, comment, score, comment_time FROM comment WHERE inventory_id = ? ORDER BY comment_time DESC");
                    $sql->bind_param("s", $inventory_id);
                    $sql->execute();
                    $sql->bind_result($user_id, $comment, $score, $comment_time);
                    $sql->store_result();
                    if($sql->num_rows > 0){
                        while($sql->fetch()){
                            echo "
                            <div class='container'>
                                <div class='row'>
                                    <div class='col-3'>
                                        <h3>{$user_id}</h3>
                                        <h4>{$comment_time}</h4>
                                    </div>
                                    <div class='col-9'>
                                        <h3>{$score}</h3>
                                        <h4>{$comment}</h4>
                                    </div>
                                </div>  
                            </div>
                            ";
                        }
                    }else{
                        echo "<h2>" . "No Comment Yet" . "</h2>";
                    }
                }
            ?>
        </div>
        
    </div>
</body>
</html>


