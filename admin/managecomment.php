<?php
$id = $_GET['id'];
$sqlPost = "SELECT u.firstName, u.lastName, p.id, p.message, p.photo, p.createdAt
          FROM users u INNER JOIN post p ON u.id = p.userId
          AND p.id = $id ORDER BY p.createdAt DESC
        ";
$qPost = mysqli_query($conn, $sqlPost);
$post = mysqli_fetch_array($qPost);
$poster = "$post[firstName] $post[lastName]";
$photo = $post['photo'];
?>
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.php?menu=admin_main">Admin Dashboard</a>
    <a class="breadcrumb-item" href="index.php?menu=managepost">Manage Posts</a>
    <a class="breadcrumb-item" href="index.php?menu=managecomment&id=<?php echo $id; ?>">Manage Comments</a>
</nav>
<div class="h1 text-center">
    Manage Comments
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <?php echo $poster ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <?php echo $post['message'] ?>
                    </p>
                </div>
                <div class="card-footer">
                    Posted on: <?php echo $post['createdAt'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Comments</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                        $sqlComments = "SELECT u.firstName, u.lastName, u.profilePicture, c.id, c.message, c.photo, 
                            c.createdAt
                            FROM users u INNER JOIN comment c ON u.id = c.userId
                            AND c.postId = $id ORDER BY c.createdAt
                        ";
                        $qComment = mysqli_query($conn,$sqlComments);
                        while($comment=mysqli_fetch_array($qComment)){
                            $cid = $comment['id'];
                            $commenter = "$comment[firstName] $comment[lastName]";
                            $photo = $comment['photo'];
                            $commenterProfilePic = $comment['profilePicture'];
                    ?>
                            <li class="list-group-item">
                                <div class="fw-bold">
                                    <img src="<?php echo "$profilePicPath/$commenterProfilePic"; ?>" style="width:30px;">
                                    <?php echo $commenter; ?>
                                </div>
                                <?php
                                if(!is_null($comment['photo'])){
                                ?>
                                    <div class="mt-2">
                                        <img class="img-thumbnail" style="width:200px;" src="<?php echo "$commentPhotoPath/$comment[photo]" ?>" alt="">
                                        <?php echo $comment['photo']; ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="mt-2 ms-3">
                                    <?php echo $comment['message']; ?>
                                </div>
                                <div class="mt-2">
                                    <div class="row">
                                        <div class="col">
                                            On: <?php echo $comment['createdAt']; ?>
                                        </div>
                                        <div class="col" style="text-align:right">
                                            <a href="admin/deletecomment.php?id=<?php echo $cid; ?>&pid=<?php echo $id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                        </div>
                                    </div>   
                                </div>
                            </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>