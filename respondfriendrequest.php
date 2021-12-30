<?php
    session_start();
    include("connect.php");
    $reqId = $_GET['id'];
    $status = $_GET['status'];
    $sqlRespond = "UPDATE friend SET status='$status', updatedAt=now() WHERE id=$reqId ";
    // echo $sqlRespond;die();
    $qRespond = mysqli_query($conn,$sqlRespond);
    if($qRespond){
        header("location:index.php");
    }
?>