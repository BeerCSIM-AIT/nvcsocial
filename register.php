<div class="h1 text-center">
    Register
</div>
<hr>
<div class="container container-fluid">

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

    <form action="checkregister.php" method="POST">
        <!-- FirstName -->
        <label for="fristname" class="col-sm-12 col-form-label">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" required>
        <!-- LastName -->
        <label for="lastname" class="col-sm-12 col-form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" required>
        <!-- E-mail -->
        <label for="email" class="col-sm-12 col-form-label">E-Mail</label>
        <input type="email" class="form-control" name="email" id="email" required>
         <!-- Show error when password not math -->
         <?php 
            if(isset($_SESSION['errMsgUser'])){
        ?>
                <div class="alert-danger pt-1 pb-1">
                    <?php
                        echo $_SESSION['errMsgUser'];
                    ?>
                </div>
        <?php 
            }
        ?>

        <!-- Password -->
        <label for="password" class="col-sm-12 col-form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
        <!-- Confirm password -->
        <label for="confirmpassword" class="col-sm-12 col-form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
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
        <button type="submit" class="btn btn-success mt-5 container-fluid">Register</button>
    </form>

</div>