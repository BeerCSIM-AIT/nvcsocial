<?php
session_start();
include("connect.php");
include("settings.inc.php");

$postId = $_POST['postId'];
$message = $_POST['postMessage'];
$uploadOk = 0;
if (is_uploaded_file($_FILES['postPhoto']["tmp_name"])) {
    //เปลี่ยนค่าตาม path ของรูปที่จะเปลี่ยน (profile,post,comment)
    $target_dir = $postPhotoPath;

    //เก็บชื่อไฟล์เป็นเวลาปัจจุบัน (timestamp)
    $filename = basename($_FILES["postPhoto"]["name"]);
    // $filename = $id . "-" . date_timestamp_get(date_create());

    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $filename =  date_timestamp_get(date_create()) . ".$imageFileType";
    
    if (move_uploaded_file($_FILES["postPhoto"]["tmp_name"], $target_dir . $filename)) {
        echo "The file " . htmlspecialchars(basename($_FILES["postPhoto"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $uploadOk = 1;
}
// echo $uploadOk; die();
if ($uploadOk == 1){
    $sql = "UPDATE post SET message='$message', photo='$filename', updatedAt=now()
    WHERE id=$postId";
}
else{
    $sql = "UPDATE post SET message='$message', updatedAt=now()
    WHERE id=$postId";
}
// echo $sql; die();
$qUser = mysqli_query($conn, $sql);
if ($qUser) {
    unset($_SESSION['errMsg']);
} else {
    $_SESSION['errMsg'] = "Error updating profile" . $sql;
}
header("location:index.php");
