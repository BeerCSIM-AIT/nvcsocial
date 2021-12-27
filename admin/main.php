<nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.php?menu=admin_main">Admin Dashboard</a>
</nav>
<div class="h1 text-center">
    Administrator Zone
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="card text-center">
                <div class="card-header text-white bg-info fw-bold">
                    Posts
                </div>
                <div class="card-body">
                    <p class="card-text h3">Total Posts</p>
                    <div class="card-text h1">
                        <?php
                            $sqlPost = "SELECT COUNT(*) FROM post";
                            $qPost = mysqli_query($conn, $sqlPost);
                            $post = mysqli_fetch_array($qPost);
                            $totalPost = $post[0];
                            echo $totalPost;
                        ?>
                    </div>
                    <p class="text-center mt-3">
                        <a href="index.php?menu=managepost" class="btn btn-info">Manage Posts</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-center">
                <div class="card-header text-white bg-success fw-bold">
                    Users
                </div>
                <div class="card-body">
                    <p class="card-text h3">Total Users</p>
                    <div class="card-text h1">
                        <?php
                            $sqlUsers = "SELECT COUNT(*) FROM users";
                            $qUsers = mysqli_query($conn, $sqlUsers);
                            $user = mysqli_fetch_array($qUsers);
                            $totalUsers= $user[0];
                            echo $totalUsers;
                        ?>
                    </div>
                    <p class="text-center mt-3">
                        <a href="index.php?menu=manageuser" class="btn btn-success">Manage Users</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>