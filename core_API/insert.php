<?php

header('Content-Type: application/json');

include_once('include/db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $cat = $data['cat'];
    $sub_cat = $data['sub_cat'];
    $product_name = $data['product_name'];
    $mrp = $data['mrp'];
    if(!empty($cat) and !empty($sub_cat) and !empty($product_name) and !empty($mrp)){
        $check = mysqli_query($conn, "insert into product_list (cat, sub_cat, product_name, mrp) values('$cat', '$sub_cat', '$product_name', '$mrp') ");
        if($check){
            echo json_encode(array('message' => 'Record Insert Successfully', 'status' => true));
        }
        else{
            echo json_encode(array('message' => 'Something Went Wrong', 'status' => false));
        }
    }
    else{
        echo json_encode(array('message' => 'All Fields Requireds', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'Only POST Method Allowed', 'status' => false));
}
