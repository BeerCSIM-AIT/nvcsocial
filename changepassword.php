<div class="h1 text-center">
    Change Password
</div>
<hr>
<div class="container">
<!-- Check Error -->
<?php
            if(isset($_SESSION['errMsg'])){
            ?>
                <div class="row">
                    <div class="col text-center" style="color:red">
                        <?php echo $_SESSION['errMsg']; ?>
                    </div>
                </div>
            <?php
            }
        ?>
<!-- Check Error -->

   <form action="actionchangepassword.php" method="POST">
        <!-- old Password -->
        <label for="password" class="col-sm-12 col-form-label">Old Password</label>
        <input type="password" class="form-control container-fluid" name="oldpassword" id="oldpassword" required>
        <!-- Show error when password not math old password -->
        <?php 
            if(isset($_SESSION['errPwdNotSameOld'])){
        ?>
                <div class="alert-danger pt-1 pb-1">
                    <?php
                        echo $_SESSION['errPwdNotSameOld'];
                    ?>
                </div>
        <?php 
            }
        ?>
        <!-- New Password -->
        <label for="newpassword" class="col-sm-12 col-form-label">New Password</label>
        <input type="password" class="form-control container-fluid" name="newpassword" id="newpassword" required>
        <!-- Show error new password same old password -->
        <?php 
            if(isset($_SESSION['errPwdSameOld'])){
        ?>
                <div class="alert-danger pt-1 pb-1">
                    <?php
                        echo $_SESSION['errPwdSameOld'];
                    ?>
                </div>
        <?php 
            }
        ?>
        <!-- Confirm Password -->
        <label for="confirmpassword" class="col-sm-12 col-form-label">Confirm Password</label>
        <input type="password" class="form-control container-fluid" name="confirmpassword" id="confirmpassword" required>
        <!-- Show error when password not math -->
        <?php 
            if(isset($_SESSION['errMsgConfirmpassword'])){
        ?>
                <div class="alert-danger pt-1 pb-1">
                    <?php
                        echo $_SESSION['errMsgConfirmpassword'];
                    ?>
                </div>
        <?php 
            }
        ?>
        <!-- Button Submit -->
        <button type="submit" class="btn btn-info mt-5 container-fluid">Change Password</button>
   </form>
</div>