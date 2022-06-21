<?php
header('Content-Type: application/json');

include_once('include/db.php');

$data = json_decode(file_get_contents("php://input"), true);

$method = $data['method'];
switch ($method) {

    case 'insert':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $cat = $data['cat'];
            $sub_cat = $data['sub_cat'];
            $product_name = $data['product_name'];
            $mrp = $data['mrp'];
            if (!empty($cat) and !empty($sub_cat) and !empty($product_name) and !empty($mrp)) {
                $check = mysqli_query($conn, "insert into product_list (cat, sub_cat, product_name, mrp) values('$cat', '$sub_cat', '$product_name', '$mrp') ");
                if ($check) {
                    echo json_encode(array('message' => 'Record Insert Successfully', 'status' => true));
                } else {
                    echo json_encode(array('message' => 'Something Went Wrong', 'status' => false));
                }
            } else {
                echo json_encode(array('message' => 'All Fields Requireds', 'status' => false));
            }
        } else {
            echo json_encode(array('message' => 'Only POST Method Allowed', 'status' => false));
        }

    case 'fetch_all':
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $products = array();
            $q1 = mysqli_query($conn, "select * from product_list ");
            if (mysqli_num_rows($q1) > 0) {
                while ($row = mysqli_fetch_assoc($q1)) {
                    $products[] = $row;
                }
                echo json_encode($products);
            } else {
                echo json_encode(array('message' => 'NO DATA FOUND', 'status' => false));
            }
        } else {
            echo json_encode(array('message' => 'Only GET Method allowed', 'status' => false));
        }

    case 'fetch_one':
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = $data['id'];
            if (!empty($id)) {
                $products = array();
                $q1 = mysqli_query($conn, "select * from product_list where id=$id ");
                if (mysqli_num_rows($q1) == 0) {
                    echo json_encode(array('message' => 'NO DATA FOUND', 'status' => false));
                } else {
                    while ($data = mysqli_fetch_assoc($q1)) {
                        $products[] = $data;
                    }
                    echo json_encode($products);
                }
            } else {
                echo json_encode(array('message' => 'All Fields Requireds', 'status' => false));
            }
        } else {
            echo json_encode(array('message' => 'Only GET Method allowed', 'status' => false));
        }

    case 'update':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
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

    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
}
