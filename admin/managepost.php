<?php
    $sqlPost = "SELECT u.firstName, u.lastName, p.id, p.message, p.photo, p.createdAt
          FROM users u INNER JOIN post p ON u.id = p.userId ORDER BY p.createdAt DESC
        ";
    $qPost = mysqli_query($conn, $sqlPost);
?>
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.php?menu=admin_main">Admin Dashboard</a>
    <a class="breadcrumb-item" href="index.php?menu=managepost">Manage Posts</a>
</nav>
<div class="h1 text-center">
    Manage Post
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:20%">Poster</th>
                        <th>Message</th>
                        <th style="width:10%">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row=mysqli_fetch_array($qPost)){
                            $id = $row['id'];
                            $poster = "$row[firstName] $row[lastName]";
                            $photo = $row['photo'];
                    ?>
                    <tr>
                        <td><?php echo $poster; ?></td>
                        <td>
                            <?php
                                if(!is_null($row['photo'])){
                            ?>
                                <div>
                                    <img class="img-thumbnail" style="width:200px;" src="<?php echo "$postPhotoPath/$photo" ?>" alt="">
                                </div>
                            <?php
                                }
                            ?>
                            <div>
                                <?php echo $row['message']; ?>
                            </div>
                            <div class="mt-3">
                                Posted On: <?php echo $row['createdAt']; ?>
                            </div>
                        </td>
                        <td>
                            <a href="admin/deletepost.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>