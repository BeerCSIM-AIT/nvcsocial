<?php
    session_start();
    include("connect.php");
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' AND passwordHash='$pass'";
    $qUser = mysqli_query($conn,$sql);
    if(mysqli_num_rows($qUser)==1){
        $user = mysqli_fetch_array($qUser);
        $_SESSION['user']['id'] = $user['id'];
        // $_SESSION['user']['profilePic'] = $user['profilePicture'];
        $_SESSION['user']['email'] = $user['email'];
        // $_SESSION['user']['firstName'] = $user['firstName'];
        // $_SESSION['user']['lastName'] = $user['lastName'];
        // $_SESSION['user']['loginName'] = $user['firstName'] . " " . $user['lastName'] ;
        header("location:index.php");
    } else{
        $_SESSION['errMsg'] = "Invalid username or password!";
        header("location:index.php?menu=login");
    }
?>