<?php
header('Content-Type: application/json');

include_once('include/db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    if (!empty($id)) {
        $check = mysqli_query($conn, "select * from product_list where id = '$id' ");
        if (mysqli_num_rows($check) == 0) {
            echo json_encode(array('message' => 'NO RECORD FOUND', 'status' => false));
        } else {
            $sql = mysqli_query($conn, "delete from product_list where id = '$id' ");
            if ($sql) {
                echo json_encode(array('message' => 'RECORD DELETED SUCCESSFULLY', 'status' => true));
            } else {
                echo json_encode(array('message' => 'SOMETHING WENT WRONG', 'status' => false));
            }
        }
    } else {
        echo json_encode(array('message' => 'All Fields Requireds', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'ONLY POST METHOD ALLOWED', 'status' => false));
}
