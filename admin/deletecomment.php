<?php
    include("../connect.php");
    $pid=$_GET['pid'];
    $id = $_GET['id'];
    $sqlDel = "DELETE FROM comment WHERE id = $id";
    $qDelete = mysqli_query($conn, $sqlDel);
    if($qDelete){
        header("location:../index.php?menu=managecomment&id=$pid");
    }else{
        echo "Error on deleting";
    }
?>