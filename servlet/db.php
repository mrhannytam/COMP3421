<?php
function DBConnection(){
    $host = "den1.mysql2.gear.host";
    $user = "petlato";
    $password = "Vz4i~S-T3Ps4";
    $database = "petlato";
    $con = mysqli_connect($host, $user, $password, $database);
    return $con;
}
?>