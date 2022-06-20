<?php
header('Content-type: application/json');

include_once('include/db.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $products = array();
    $q1 = mysqli_query($conn, "select * from product_list where id = '$id' ");
    if(mysqli_num_rows($q1)==0){
        echo json_encode(array('message'=> 'NO DATA FOUND', 'status'=> false));
    }
    else{
        while($data = mysqli_fetch_assoc($q1)){
            $products[] = $data;
        }
        echo json_encode($products);
    }
}