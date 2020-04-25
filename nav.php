<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Petlato</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <form class="form-inline my-2 my-lg-0" id="search_form">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searching" id="search_bar">
        <button type="submit" class="btn btn-default"><img src="./image/search.png" height="20" width="20"></button>
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </form>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php
                if(!isset($_SESSION)){ 
                    session_start(); 
                } 
                if(isset($_SESSION['user']['user_id']) && !empty($_SESSION['user']['user_id'])){
                    require_once('servlet/db.php');
                    $con = DBConnection();
                    $sql = $con->prepare('SELECT profile_image FROM user WHERE user_id = ?');
                    $sql->bind_param("s", $_SESSION['user']['user_id']);
                    $sql->execute();
                    $sql->store_result();
                    $sql->bind_result($profile_image);
                    $sql->fetch();
                    if($sql->num_rows > 0){
                        echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="' . substr($profile_image,1) . '" width=20 height=20> Hello, ' . $_SESSION['user']['user_id'] . '
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="accountSetting.php">Account Setting</a>
                                    <a class="dropdown-item" href="orderHistory.php">Order History</a>
                                    <a class="dropdown-item" href="reward.php">Reward Gift</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </li>
                        ';
                    }else{
                        echo "
                            <script>You action has been reported</script>
                        ";
                    }
                }else{
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php"><span class="glyphicon glyphicon-lock"></span> Register</a>
                        </li>
                        ';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#"><span class="glyphicon glyphicon-bell"></span> Notification</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="list.php"><span class="glyphicon glyphicon-th-list"></span> My List</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"> Cart</a>
            </li>
        </ul>
    </div>
</nav>