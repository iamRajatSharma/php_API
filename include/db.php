<?php

$conn = mysqli_connect('localhost', 'localhost', 'root', 'samvah');
if(!$conn){
    echo "DB FAILED";
    exit();
}