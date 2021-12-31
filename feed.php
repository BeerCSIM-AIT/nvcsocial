<?php
$sqlPost = "SELECT p.id, p.userId, p.message, p.photo, p.createdAt,
 u.firstName, u.lastName, u.profilePicture
 FROM post p INNER JOIN users u ON p.userId = u.id
 WHERE p.userId = $id OR p.userId IN (
     SELECT sourceId FROM friend WHERE targetId = $id
     UNION
     SELECT targetId FROM friend WHERE sourceId = $id AND status='accepted'
 )
 ORDER BY p.createdAt DESC
";
$qPost = mysqli_query($conn, $sqlPost);
?>
<div class="row mt-3">
    <div class="col-md-9 order-md-1 order-sm-last mt-sm-3">
        <div class="row">
            <div class="col-md-12">
                <form class="d-flex" action="createpost.php" method="post" enctype="multipart/form-data">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label h3">What do you feel now:</label>
                            <div class="mt-2">
                                <textarea class="form-control" name="postMessage" id="" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="mb-2">
                            <input class="form-control" type="file" name="postPhoto" id="">
                        </div>
                        <div class="mb-2">
                            <div class="d-grid gap-2">
                                <button type="submit" name="btnPost" id="btnPost" class="btn btn-primary">
                                    Post
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="mt-2 mx-1">
            <div class="col-md-12">
                <div class="h4">Recent Posts</div>
                <div class="row">
                    <?php
                    while ($post = mysqli_fetch_array($qPost)) {
                        $pid = $post['id'];
                        $poster = "$post[firstName] $post[lastName]";
                        $posterProfilePic = $post['profilePicture'];
                    ?>
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <img src="<?php echo "$profilePicPath/$posterProfilePic"; ?>" style="width:30px;">
                                            <?php echo $poster; ?>
                                        </div>
                                        <div class="col-sm-4" style="text-align:right">
                                            <?php
                                            if ($post['userId'] == $id) {
                                            ?>
                                                <div class="dropdown open">
                                                    <button class="btn btn-info dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        ...
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                                        <a class="dropdown-item" href="index.php?menu=editpost&id=<?php echo $pid; ?>">Edit</a>
                                                        <a class="dropdown-item" href="deletepost.php?id=<?php echo $pid; ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (!is_null($post['photo'])) {
                                    ?>
                                        <div class="mt-2">
                                            <img class="img-thumbnail" style="width:200px;" src="<?php echo "$postPhotoPath/$post[photo]" ?>" alt="">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <p class="card-text mt-3">
                                        <?php echo $post['message'] ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    Posted on: <?php echo $post['createdAt'] ?>
                                </div>
                                <div class="card-body">
                                    <div class="h5">Comments</div>
                                    <ul class="list-group list-group-flush">
                                        <div class="card">
                                            <li class="list-group-item">
                                                <form class="d-flex" action="createcomment.php" method="post" enctype="multipart/form-data">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <div class="mt-2">
                                                                <input type="text" name="commentMessage" class="form-control" required>
                                                                <input type="hidden" name="postId" value="<?php echo $pid; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <input class="form-control" type="file" name="commentPhoto" id="">
                                                                </div>
                                                                <div class="col-md-2 d-grid gap-2">
                                                                    <button type="submit" name="btnPost" id="btnPost" class="btn btn-primary">
                                                                        Comment
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </li>
                                            <?php
                                            $sqlComments = "SELECT u.firstName, u.lastName, u.profilePicture, c.id, c.message, c.photo,c.createdAt, c.userId
                                            FROM users u INNER JOIN comment c ON u.id = c.userId
                                            AND c.postId = $pid ORDER BY c.createdAt
                                            ";
                                            $qComment = mysqli_query($conn, $sqlComments);
                                            while ($comment = mysqli_fetch_array($qComment)) {
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
                                                    if (!is_null($comment['photo'])) {
                                                    ?>
                                                        <div class="mt-2">
                                                            <img class="img-thumbnail" style="width:200px;" src="<?php echo "$commentPhotoPath/$comment[photo]" ?>" alt="">
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
                                                            <?php
                                                            if ($comment['userId'] == $id) {
                                                            ?>
                                                                <div class="col" style="text-align:right">
                                                                    <a href="deletecomment.php?id=<?php echo $cid; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 order-md-2 order-sm-first">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo "$profilePicPath/$profilePic"; ?>" style="width:60px;" class="img-thumbnail me-2">
                <?php echo $loginName; ?>
            </div>
        </div>
        <hr>
       <?php include("friendzone.php"); ?>
    </div>
</div>