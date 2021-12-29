<?php
    $host="nvc-db.c5lttagztqjo.ap-southeast-1.rds.amazonaws.com";
    $user="nvc_social";
    $pass="nvc_social2021";
    $dbname="nvc_social";
    $conn = mysqli_connect($host,$user,$pass,$dbname);
    if(!$conn){
        echo "Error while connecting: ";
    }
?>