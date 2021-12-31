<div class="row mt-3">
    <div class="col h1">
        All Friends
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-md-4">
        <div class="my-3">
            <div class="h3">Your Friends</div>
        </div>
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
                                <div class="col-md-2">
                                    <img src="<?php echo "$profilePicPath/$reqProfilePic"; ?>" style="width:100%">
                                </div>
                                <div class="col-md-10">
                                    <div class="row mt-1">
                                        <div class="col">
                                            <?php echo $reqName; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <a href="respondfriendrequest.php?id=<?php echo $reqId; ?>&status=unfriended" class="badge bg-danger" onclick="return confirm('Are you sure to unfriend?')">
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
    <div class="col-md-4">
        <div class="my-3">
            <div class="h3">Requests Sent</div>
        </div>
        <div class="card">
            <ul class="list-group list-group-flush">
                <?php
                $sqlFriend = "SELECT f.id, u.firstName, u.lastName, u.profilePicture 
                    FROM friend f INNER JOIN users u ON f.targetId = u.id WHERE f.sourceId = $id 
                        AND f.status='new'
                    ";
                $qFriendReq = mysqli_query($conn, $sqlFriend);
                if (mysqli_num_rows($qFriendReq) == 0) {
                ?>
                    <li class="list-group-item">No friend request sent now.</li>
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
                                    <div class="row mt-1">
                                        <div class="col">
                                            <?php echo $reqName; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <a href="respondfriendrequest.php?id=<?php echo $reqId; ?>&status=cancel" class="badge bg-danger" onclick="return confirm('Are you sure to cancel this friend request?')">
                                                Cancel Request
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
    <div class="col-md-4">
        <div class="my-3">
            <div class="h3">People You May Know</div>
        </div>
        <div class="card">
            <ul class="list-group list-group-flush">
                <?php
                $sqlFriend = "SELECT * FROM users u WHERE id NOT IN (
                                    SELECT sourceId FROM friend WHERE targetId = $id
                                    UNION
                                    SELECT targetId FROM friend WHERE sourceId = $id
                            ) AND id <> $id";
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
                                <div class="col-md-2">
                                    <img src="<?php echo "$profilePicPath/$reqProfilePic"; ?>" style="width:100%">
                                </div>
                                <div class="col-md-10">
                                    <div class="row mt-1">
                                        <div class="col">
                                            <?php echo $reqName; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <a href="respondfriendrequest.php?id=<?php echo $reqId; ?>&status=new" class="badge bg-primary">
                                                Add friend
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