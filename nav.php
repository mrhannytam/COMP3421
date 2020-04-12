<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Petlato</a>
    </div>
    <div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="content-search">
                </div>
                    <button type="submit" class="btn btn-default"><img src="./image/search.png" height="20" width="20"></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    session_start();
                    if(isset($_SESSION['user']['user_id'])){
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
                            <li id="logout"><a href="logout.php"><img src="' . substr($profile_image,1) . '" width=20 height=20> Account/ Logout</a></li>
                            ';
                            //The path upload is ../image/XX.jpg (Because of web security, we can't set a static path to C drive)
                            //So we need to remove the first '.' to retrieve the image
                        }else{
                            echo '
                            <li id="logout"><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Account/ Logout</a></li>
                            ';
                        }
                    }else{
                        echo '
                        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
                        <li><a href="registration.php"><span class="glyphicon glyphicon-lock"></span> Register</a></li>
                        ';
                    }
                ?>
                <li><a href="#"><span class="glyphicon glyphicon-bell"></span> Notification</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-th-list"></span> My List</a></li>
                <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>             
            </ul>
        </div>
    </div>
    </div>
</nav>