<?php
    include("../connect.php");
    $id = $_GET['id'];
    $sqlDel = "DELETE FROM post WHERE id = $id";
    $qDelete = mysqli_query($conn, $sqlDel);
    if($qDelete){
        header("location:../index.php?menu=managepost");
    }else{
        echo "Error on deleting";
    }
?>