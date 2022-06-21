<?php
header('Content-Type: application/json');

include_once('include/db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $cat = $data['cat'];
    $check = mysqli_query($conn, "select * from product_list where id = $id ");
    if (!empty($id) and !empty($cat)) {
        if (mysqli_num_rows($check) == 0) {
            echo json_encode(array('message' => 'Product ID Not Found', 'status' => false));
        } else {
            $sql = mysqli_query($conn, "update product_list set cat = '$cat' where id = '$id'  ");
            if ($sql) {
                echo json_encode(array('message' => 'Data Updated Successfully', 'status' => true));
            } else {
                echo json_encode(array('message' => 'Something Went Wrong', 'status' => false));
            }
        }
    } else {
        echo json_encode(array('message' => 'All Fields Requireds', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'Only POST method allowed', 'status' => false));
}
