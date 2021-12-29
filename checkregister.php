<?php 
    session_start();
    include("connect.php");
    //Un set session error checking email and comfirmpassword
    unset($_SESSION['errMsgConfirmpassword']);
    unset($_SESSION['errMsgUser']);
    unset($_SESSION['errMsg']);

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    // Check Confirm Password
    if($password != $confirmpassword){
        $_SESSION['errMsgConfirmpassword'] = "The passwords do not match. Please check again.";
        echo "<script>window.location.href = 'index.php?menu=register';</script>";
    }
    //Select Query
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $qCheckUser = mysqli_query($conn, $sql);

    // Check User in use in database.
    if(mysqli_num_rows($qCheckUser)==1){
        $_SESSION['errMsgUser'] = "This user is already in use.";
        echo "<script>window.location.href = 'index.php?menu=register';</script>";
    }else{
        //Insert Query
        $sql = "INSERT INTO nvc_social.users 
        (firstname, lastName, email, passwordHash)
        VALUES ('$firstname', '$lastname','$email', '$password')";
        $qInsertuser = mysqli_query($conn, $sql);

        //Check Query
        if(!$qInsertuser){
            $_SESSION['errMsg'] = "Error Query..!";
            echo "<script>window.location.href = 'index.php?menu=register';</script>";
        }else{
            //Success
            echo "<script>
            window.alert('Register Success!');
            window.location.href = 'index.php?menu=login';</script>";
            }
        }
?>