<?php
session_start();
include("connect.php");
include("settings.inc.php");
$id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$tel = $_POST['tel'];
$gender = $_POST['gender'];
$email = $_POST['email'];

$target_dir = $profilePicPath;

//เก็บชื่อไฟล์เป็นเวลาปัจจุบัน (timestamp)
$filename = basename($_FILES["profilePic"]["name"]);
// $filename = $id . "-" . date_timestamp_get(date_create());

$target_file = $target_dir . $filename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["profilePic"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    $filename = $id . "-" . date_timestamp_get(date_create()) . ".$imageFileType";
    if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_dir.$filename)) {
        echo "The file " . htmlspecialchars(basename($_FILES["profilePic"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if($uploadOk==1)
    $strPic = "profilePicture='$filename',";
else $strPic = "";

$sql = "UPDATE users SET 
            firstName='$firstName',
            lastname='$lastName',
            tel='$tel',
            email='$email',
            $strPic
            gender='$gender'
            WHERE id = $id";
$qUser = mysqli_query($conn, $sql);
if ($qUser) {
    session_unset("errMsg");
} else {
    $_SESSION['errMsg'] = "Error updating profile";
}
header("location:index.php?menu=profile");

?>
