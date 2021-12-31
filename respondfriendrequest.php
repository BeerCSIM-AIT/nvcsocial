<?php
    session_start();
    include("connect.php");
    $reqId = $_GET['id'];
    $status = $_GET['status'];
    switch($status){
        case "new":{
            $userId = $_SESSION['user']['id'];
            $sqlRespond = "INSERT INTO friend (sourceId, targetId) VALUES ($userId, $reqId)";
            break;
        }
        case "accepted":
        case "rejected":
        case "unfriended":{
            $sqlRespond = "UPDATE friend SET status='$status', updatedAt=now() WHERE id=$reqId ";
            break;
        }
        case "cancel":{
            $sqlRespond = "DELETE FROM friend WHERE id = $reqId";
            break;
        }
    }
    // echo $sqlRespond;die();
    $qRespond = mysqli_query($conn,$sqlRespond);
    if($qRespond){
        if($status=="accepted"||$status=="rejected")
            header("location:index.php");
        else
            header("location:index.php?menu=friends");
    }
?>