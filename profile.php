<?php
    include("connect.php");
    $id = $_SESSION['user']['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $qUser = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($qUser);
    $profilePic = $row['profilePicture'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $gender = $row['gender'];
    $tel = $row['tel'];
?>
<div class="h1 text-center">
    Profile
</div>
<hr>
<div class="container">
    <div class="container">
        <?php
        if (isset($_SESSION['errMsg'])) {
        ?>
            <div class="row">
                <div class="col text-center" style="color:red">
                    <?php echo $_SESSION['errMsg']; ?>
                </div>
            </div>
        <?php
        }
        ?>
        <form action="updateuser.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="profilePic" class="col-sm-2 col-form-label">Profile Picture: </label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="<?php echo "$profilePicPath/$profilePic"?>" style="width: 200px" class="img-thumbnail">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <input class="form-control" type="file" name="profilePic">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="mb-3 row">
                <label for="firstName" class="col-sm-2 col-form-label">First name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $firstName; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lastName" class="col-sm-2 col-form-label">Last name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $lastName; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tel" class="col-sm-2 col-form-label">Telephone number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $tel; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <?php
                    if ($gender == "M") {
                        $chkMale = "checked='checked'";
                    } else {
                        $chkMale = "";
                    }

                    if ($gender == "F") {
                        $chkFemale = "checked='checked'";
                    } else {
                        $chkFemale = "";
                    }
                    ?>
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="M" <?php echo $chkMale; ?>> Male
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="F" <?php echo $chkFemale; ?>> Female
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
    <div class="mb-3 row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
    </form>
</div>
</div>