<?php
    $host="localhost:3306";
    $user="root";
    $pass="12345678";
    $dbname="nvc_social";
    $conn = mysqli_connect($host,$user,$pass,$dbname);
    if(!$conn){
        echo "Error while connecting: ";
    }
?>