<?php 
    include("connect.php");
    session_start();
    $id = $_SESSION['user']['id'];
    $oldpassword = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['newpassword']);
    $confirmpassword = md5($_POST['confirmpassword']);
    if(isset($_SESSION['errPwdSameOld'])){
        session_unset($_SESSION['errPwdSameOld']);
    }

    if(isset($_SESSION['errMsgConfirmpassword'])){
        session_unset($_SESSION['errMsgConfirmpassword']);
    }

    if(isset($_SESSION['errPwdNotSameOld'])){
        session_unset($_SESSION['errPwdNotSameOld']);
    }

    // Select query (Password)
    $sql = "SELECT * FROM users WHERE id = $id";
    $qUser = mysqli_query($conn, $sql);
    // Fetch password
    $result = mysqli_fetch_array($qUser);
    $password = $result["passwordHash"];

    //Check password currently in use
    if($oldpassword != $password){
        $_SESSION['errPwdNotSameOld'] = "The passwords not college.";
        header('location:index.php?menu=changepassword');
        die();
    }else if($oldpassword == $newpassword){
        $_SESSION['errPwdSameOld'] = "Password is currently in use.";
        header('location:index.php?menu=changepassword');
        die();
    }else if($newpassword != $confirmpassword){
        $_SESSION['errMsgConfirmpassword'] = "The passwords do not match. Please check again.";
        header('location:index.php?menu=changepassword');
        die();
    }else{
    // $sql = "UPDATE users SET passwordHash = '$newpassword' WHERE id = $id"
    // $qChangePassword = mysqli_query($conn, $sql)
    echo "colletg all";
    }
    

    

?>