<?php
    include("connect.php");
    $id = $_GET['id'];
    $sqlDel = "DELETE FROM comment WHERE id = $id";
    $qDelete = mysqli_query($conn, $sqlDel);
    if($qDelete){
        header("location:index.php");
    }else{
        echo "Error on deleting";
    }
?>