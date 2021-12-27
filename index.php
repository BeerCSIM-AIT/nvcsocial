<?php
session_start();
include("settings.inc.php");
include("connect.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>NVC Social</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">NVC Social</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="visually-hidden">(current)</span></a>
                    </li>
                    <?php
                    if (!isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=register">Register</a>
                        </li>
                    <?php
                    } else {
                        $id = $_SESSION['user']['id'];
                        $sql = "SELECT * FROM users WHERE id = $id";
                        $qUser = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($qUser);
                        $profilePic = $row['profilePicture'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $role = $row['userRole'];
                        $loginName = $firstName . " " . $lastName;
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo "$profilePicPath/$profilePic"; ?>" style="width:30px;">
                                <?php echo $loginName; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <?php
                                    if($role=='administrator'){
                                ?>
                                    <a href="index.php?menu=admin_main" class="dropdown-item">Admin Zone</a>
                                    <hr class="dropdown-divider">
                                <?php
                                    }
                                ?>
                                <a class="dropdown-item" href="index.php?menu=profile">Profile</a>
                                <a class="dropdown-item" href="index.php?menu=changepassword">Change Password</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php
        if (isset($_GET['menu'])) {
            $menu = $_GET['menu'];
        } else {
            $menu = "";
        }
        switch ($menu) {
            case "login": {
                    $page = "login.php";
                    break;
                }
            case "register": {
                    $page = "register.php";
                    break;
                }
            case "profile": {
                    $page = "profile.php";
                    break;
                }
            case "changepassword": {
                    $page = "changepassword.php";
                    break;
                }
            case "admin_main": {
                    $page = "admin/main.php";
                    break;
            }
            case "manageuser": {
                    $page = "admin/manageuser.php";
                    break;
            }
            case "managepost": {
                    $page = "admin/managepost.php";
                    break;
            }
            case "managecomment": {
                $page = "admin/managecomment.php";
                break;
            }
            default: {
                    $page = "main.php";
                    break;
                }
        }
        include($page);
        ?>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>