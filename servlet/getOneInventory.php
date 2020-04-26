<?php
    $status = "fail";
    $data = "none";

    if(isset($_POST['inventory_id']) && !empty($_POST['inventory_id'])){
        require_once('db.php');
        $con = DBConnection();
        $inventory_id = $_POST['inventory_id'];


        $sql = $con->prepare("SELECT inventory_name, inventory_image, price FROM inventory WHERE inventory_id = ?");
        $sql->bind_param("s", $inventory_id);
        $sql->execute();
        $sql->bind_result($inventory_name, $inventory_image, $price);
        $sql->store_result();
        $sql->fetch();
        if($sql->num_rows > 0){
            $data = array(
                'inventory_name' => $inventory_name,
                'inventory_image' => $inventory_image,
                'price' => $price
            );
            $status = "success";
        }else{
            $data = "don't have this inventory";
        }
    }else{
        $data = "Cannot search null inventory";
    }
    echo json_encode(
        array(
            'status' => $status,
            'data' => $data
        )
    );
?>