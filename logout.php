<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}else{   
    session_destroy();
    header('location: index.php');    
}

?>