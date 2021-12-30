<div class="row mt-3">
    <div class="col h1">
        All Friends
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col">
    <div class="card">
            <ul class="list-group list-group-flush">
                <?php
                $sqlFriend = "SELECT f.id, u.firstName, u.lastName, u.profilePicture 
                    FROM friend f INNER JOIN users u ON f.sourceId = u.id WHERE f.targetId = $id 
                        AND f.status='accepted'
                    UNION
                    SELECT f.id, u.firstName, u.lastName, u.profilePicture 
                    FROM friend f INNER JOIN users u ON f.targetId = u.id WHERE f.sourceId = $id 
                        AND f.status='accepted'
                    ";
                $qFriendReq = mysqli_query($conn, $sqlFriend);
                if (mysqli_num_rows($qFriendReq) == 0) {
                ?>
                    <li class="list-group-item">No friend now.</li>
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
                                <div class="col-md-1">
                                    <img src="<?php echo "$profilePicPath/$reqProfilePic"; ?>" style="width:100%">
                                </div>
                                <div class="col-md-11">
                                    <div class="row mt-1">
                                        <div class="col">
                                            <?php echo $reqName; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <a href="respondfriendrequest.php?id=<?php echo $reqId;?>&status=unfriended" class="badge bg-danger" onclick="return confirm('Are you sure to unfriend?')">
                                            Unfriend!
                                        </a>
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