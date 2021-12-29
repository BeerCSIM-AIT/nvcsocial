<?php
    $id=$_GET['id'];
    $sql = "SELECT * FROM post WHERE id = $id";
    $qPost = mysqli_query($conn,$sql);
    $post=mysqli_fetch_array($qPost);
    $postPhoto = $post['photo'];
?>
<div class="row mt-3">
    <div class="col h1">
        Edit Post
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-md-12">
        <form class="d-flex" action="updatepost.php" method="post" enctype="multipart/form-data">
            <div class="col">
                <div class="mb-3">
                    <img src="<?php echo "$profilePicPath/$postPhoto" ?>" style="width: 200px" class="img-thumbnail">
                </div>
                <div class="mb-2">
                    <input class="form-control" type="file" name="postPhoto" id="">
                </div>
                <div class="mb-3">
                    <div class="mt-2">
                        <input type="hidden" name="postId">
                        <textarea class="form-control" name="txtMessage" id="" rows="3"><?php echo $post['message']; ?></textarea>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="d-grid gap-2">
                        <button type="submit" name="btnPost" id="btnPost" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>