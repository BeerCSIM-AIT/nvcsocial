<?php
$sqlFriends = "SELECT COUNT(*) FROM friend WHERE status='accepted' AND (sourceId = $id OR targetId = $id )";
$qFriends = mysqli_query($conn, $sqlFriends);
if (mysqli_num_rows($qFriends) == 0)
    $friendCount = 0;
else
    $friendCount = mysqli_fetch_array($qFriends)[0];
?>
<div class="row mt-3">
    <div class="col-md-12">
        <a class="btn" href="index.php?menu=friends">
            <span class="badge bg-primary"><?php echo $friendCount; ?></span> Friends
        </a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Friend Requests</h4>
            </div>

            <ul class="list-group list-group-flush">
                <?php
                $sqlFriendReq = "SELECT f.id, u.firstName, u.lastName, u.profilePicture 
                    FROM friend f INNER JOIN users u ON f.sourceId = u.id WHERE f.targetId = $id 
                        AND f.status='new'
                    ";
                $qFriendReq = mysqli_query($conn, $sqlFriendReq);
                if (mysqli_num_rows($qFriendReq) == 0) {
                ?>
                    <li class="list-group-item">No friend requests now.</li>
                    <?php
                } else {
                    while ($friendReq = mysqli_fetch_array($qFriendReq)) {
                        // var_dump($friendReq);
                        $reqId = $friendReq['id'];
                        $reqProfilePic = $friendReq['profilePicture'];
                        $reqName = "$friendReq[firstName] $friendReq[lastName]";
                    ?>
                        <li class="list-group-item">
                            <div class="row fw-bold h-4">
                                <div class="col-md-2">
                                    <img src="<?php echo "$profilePicPath/$reqProfilePic"; ?>" style="width:100%">
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col">
                                            <?php echo $reqName; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <a href="respondfriendrequest.php?id=<?php echo $reqId;?>&status=accepted" class="badge bg-primary">Accept</a>
                                            <a href="respondfriendrequest.php?id=<?php echo $reqId;?>&status=rejected" class="badge bg-danger">Reject</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>