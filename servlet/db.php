<?php
function DBConnection(){
    $host = "localhost";
    $user = "root";
    $password = "toor";
    $database = "comp3421";
    $con = mysqli_connect($host, $user, $password, $database);
    return $con;
}
?>