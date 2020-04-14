<?php
    $status = "fail";
    $data = "none";
    require_once('db.php');
    $con = DBConnection();
    $sql = $con->prepare("SELECT * FROM inventory");
    $sql->execute();
    $sql->bind_result($inventory_id, $inventory_name, $inventory_image, $price);
    $sql->store_result();
    if($sql->num_rows > 0){
        $data = array();
        $i = 0;
        while($sql->fetch()){
            $data[$i] = array(
                'inventory_id' => $inventory_id,
                'inventory_name' => $inventory_name,
                'inventory_image' => $inventory_image,
                'price' => $price
            );
            $i++;
        }
        $status = "success";
    }else{
        $data = "Shop haven't start yet";
    }


    echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );
?>