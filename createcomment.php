<?php
session_start();
include("connect.php");
include("settings.inc.php");

$userId = $_SESSION['user']['id'];
$message = $_POST['commentMessage'];
$postId  = $_POST['postId'];
$uploadOk = 0;
if (is_uploaded_file($_FILES['commentPhoto']["tmp_name"])) {
    //เปลี่ยนค่าตาม path ของรูปที่จะเปลี่ยน (profile,post,comment)
    $target_dir = $commentPhotoPath;

    //เก็บชื่อไฟล์เป็นเวลาปัจจุบัน (timestamp)
    $filename = basename($_FILES["commentPhoto"]["name"]);
    // $filename = $id . "-" . date_timestamp_get(date_create());

    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $filename = $postId . "-" . date_timestamp_get(date_create()) . ".$imageFileType";
    
    if (move_uploaded_file($_FILES["commentPhoto"]["tmp_name"], $target_dir . $filename)) {
        echo "The file " . htmlspecialchars(basename($_FILES["profilePic"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $uploadOk = 1;
}

if ($uploadOk == 1)
    $sql = "INSERT INTO comment (postId, userId, message, photo) VALUES ($postId, $userId, '$message','$filename' )";
else
    $sql = "INSERT INTO comment (postId, userId, message) VALUES ($postId, $userId, '$message')";

$qUser = mysqli_query($conn, $sql);
if ($qUser) {
    unset($_SESSION['errMsg']);
} else {
    $_SESSION['errMsg'] = "Error updating profile" . $sql;
}
header("location:index.php");
