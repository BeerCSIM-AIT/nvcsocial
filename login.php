<div class="h1 text-center">
    Login
</div>
<hr>
<div class="row">
    <div class="container">
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
        <form action="checklogin.php" method="post">
            <div class="mb-3 row">
                <label for="email" class="col-sm-12 col-form-label">E-mail</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="email" id="email" placeholder="aaaa@xxx.com">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-12 col-form-label">Password</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>