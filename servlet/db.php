<?php
function DBConnection(){
    $host = "lolcahost";
    $user = "petlato";
    $password = "Vz4i~S-T3Ps4";
    $database = "petlato";
    $con = mysqli_connect($host, $user, $password, $database);
    return $con;
}

echo $con = DBConnection();
echo 'hi';
?>