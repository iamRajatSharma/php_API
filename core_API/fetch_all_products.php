<?php
header('Content-type: application/json');

include_once('include/db.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $products = array();
    $q1 = mysqli_query($conn, "select * from product_list ");
    if(mysqli_num_rows($q1)>0){
        while($row = mysqli_fetch_assoc($q1)){
            $products[] = $row;
        }
        echo json_encode($products);
    }
    else{
        echo json_encode(array('message' => 'NO DATA FOUND', 'status' => false));
    }
}
else{
    echo json_encode(array('message' => 'Only GET Method allowed', 'status' => false ));
}