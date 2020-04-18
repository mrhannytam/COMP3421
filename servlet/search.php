<?php
$status = "fail";
$data = "none";

if(isset($_POST['searching']) && !empty($_POST['searching'])){
    $searching = $_POST['searching'];

    require_once('db.php');
    $con = DBConnection();
    $sql = $con->prepare("SELECT * FROM inventory");
    $sql->execute();
    $sql->store_result();
    $sql->bind_result($inventory_id, $inventory_name, $inventory_image, $price);
    if($sql->num_rows > 0){
        $data = array();
        $check = false;
        $i = 0;
        while($sql->fetch()){
            if(strpos($inventory_name, $searching) !== false){
                $data[$i] = array(
                    'inventory_id' => $inventory_id,
                    'inventory_name' => $inventory_name,
                    'inventory_image' => $inventory_image,
                    'price' => $price
                );
                $i++;
                $check = true;
            }
        }
        if($check){
            $status = "success";
        }else{
            $data = "Cannot find any results";
        }
    }else{
        $data = "Yours action has been reported";
    }

}else{
    $data = "Nothing is searching";
}

echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);