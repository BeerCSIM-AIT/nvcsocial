<nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.php?menu=admin_main">Admin Dashboard</a>
    <a class="breadcrumb-item" href="index.php?menu=manageuser">Manage Users</a>
</nav>
<div class="h1 text-center">
    Manage User
</div>
<hr>
<div class="container mb-5">
    <!-- PHP SELECT NEW USESRS -->
    <?php 
        $sql = "SELECT * FROM users WHERE status = 'new'";
        $qNewUser = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($qNewUser);
    ?>
    <!-- New Users -->
    <h3><label for="newusers" class="col-sm-12 col-form-label">New Users.</label></h3>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-Mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Check User in status new -->
            <?php 
                if($rows==0){
            ?> 
            <tr>
            <td colspan="5">
                <div class="container text-center">
                    <h4>Don't have new usesr</h4>
                </div>   
            </td>   
            </tr> 
            <?php
            }
                else{
                for($i=0; $i<$rows; $i++){
                $result = mysqli_fetch_array($qNewUser);
                $id = $result['id'];
            ?>
                <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $result['firstName'];?></td>
                <td><?php echo $result['lastName'];?></td>
                <td><?php echo $result['email'];?></td>
                <td style="width:250px;">
                    <a href="index.php?menu=manageuser&action=rejected&idAction=<?php echo $id;?>" class="btn btn-danger">Reject</a>
                    <a href="index.php?menu=manageuser&action=approved&idAction=<?php echo $id;?>" class="btn btn-success">Approve</a>
                </td>
                </tr>
            <?php
                }
            }
            ?> 
        </tbody>
        
    </table>



    <!-- PHP SELECT APPROVE -->
    <?php 
        $sql = "SELECT * FROM users WHERE status = 'approved'";
        $qApproveUser = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($qApproveUser);
    ?>
    <!-- Approved Users -->
    <h3><label for="approvedusers" class="col-sm-12 col-form-label">Approved Users.</label></h3>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-Mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Check User in status aprove -->
            <?php 
                if($rows==0){
            ?> 
            <tr>
            <td colspan="5">
                <div class="container text-center">
                    <h4>Don't have approve usesr</h4>
                </div>   
            </td>
            </tr>
                    
            <?php
                }else{
                for($i=0; $i<$rows; $i++){
                $result = mysqli_fetch_array($qApproveUser);
                $id = $result['id'];
            ?>
            <tr>
                <td><?php echo  $id;?></td>
                <td><?php echo $result['firstName'];?></td>
                <td><?php echo $result['lastName'];?></td>
                <td><?php echo $result['email'];?></td>
                <td style="width:250px;">
                    <a href="index.php?menu=manageuser&action=banned&idAction=<?php echo $id;?>" class="btn btn-danger">Ban user</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>


    <!-- PHP SELECT REJECT USERS -->
    <?php 
        $sql = "SELECT * FROM users WHERE status = 'rejected'";
        $qRejectUser = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($qRejectUser);
    ?>

    <!-- Rejected Users -->
    <h3><label for="rejectusers" class="col-sm-12 col-form-label">Reject Users.</label></h3>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-Mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <!-- Check User in status rejected -->
          <?php 
                if($rows==0){
            ?> 
            <tr>
            <td colspan="5">
                <div class="container text-center">
                    <h4>Don't have rejected user</h4>
                </div>   
            </td>
            </tr>
                    
            <?php
                }else{
                for($i=0; $i<$rows; $i++){
                $result = mysqli_fetch_array($qRejectUser);
                $id = $result['id'];
            ?>
            <tr>
                <td><?php echo  $id;?></td>
                <td><?php echo $result['firstName'];?></td>
                <td><?php echo $result['lastName'];?></td>
                <td><?php echo $result['email'];?></td>
                <td style="width:250px;">
                    <a href="index.php?menu=manageuser&action=new&idAction=<?php echo $id;?>" class="btn btn-info text-light">Retry</a>
                    <a href="index.php?menu=manageuser&action=approved&idAction=<?php echo $id;?>" class="btn btn-success">Approve</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- PHP SELECT NEW REKECT USERS -->
    <?php 
        $sql = "SELECT * FROM users WHERE status = 'banned'";
        $qBanned = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($qRejectUser);
    ?>
    <!-- Baned Users -->
    <h3><label for="banusers" class="col-sm-12 col-form-label">Baner Users.</label></h3>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-Mail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Check User in status banned -->
            <?php 
                if($rows==0){
            ?> 
            <tr>
            <td colspan="5">
                <div class="container text-center">
                    <h4>Don't have banned user</h4>
                </div>   
            </td>   
            </tr>
            <?php
                }else{
                for($i=0; $i<$rows; $i++){
                $result = mysqli_fetch_array($qBanned);
                $id = $result['id'];
            ?>
            <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $result['firstName'];?></td>
                <td><?php echo $result['lastName'];?></td>
                <td><?php echo $result['email'];?></td>
                <td style="width:250px;">
                    <a href="index.php?menu=manageuser&action=approved&idAction=<?php echo $id;?>" class="btn btn-danger">Un Ban</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
    if(isset($_GET['action'])){
        $status = $_GET['action'];
        $idAction = $_GET['idAction'];
            $sql = "UPDATE users SET status ='$status' WHERE id = $id";
            $qUpdateStatus = mysqli_query($conn, $sql);
            echo "<script>window.alert('Success!');
            window.location.href = 'index.php?menu=manageuser';</script>";
    }else{
        $action = "";
    }
?>