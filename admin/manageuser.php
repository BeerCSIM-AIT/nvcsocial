<nav class="breadcrumb">
    <a class="breadcrumb-item" href="index.php?menu=admin_main">Admin Dashboard</a>
    <a class="breadcrumb-item" href="index.php?menu=manageuser">Manage Posts</a>
</nav>
<div class="h1 text-center">
    Manage User
</div>
<hr>
<div class="container mb-5">
    <?php 
        $status = array("new","approved","rejected","banned");
        foreach($status as $s){
            $sql = "SELECT * FROM users WHERE status = '$s'";
            $query = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($query);
    ?>
        <h3><label for="" class="col-sm-12 col-form-label"><?php titleShow($s);?></label></h3>
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
            <?php 
                if($rows==0){
            ?> 
            <tr>
            <td colspan="5">
                <div class="container text-center">
                    <h4>No Items</h4>
                </div>   
            </td>   
            </tr> 
            <?php
            }
                else{
                for($i=0; $i<$rows; $i++){
                $result = mysqli_fetch_array($query);
                $id = $result['id'];
            ?>
                <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $result['firstName'];?></td>
                <td><?php echo $result['lastName'];?></td>
                <td><?php echo $result['email'];?></td>
                <td style="width:250px;">
                <?php btnShow($s, $id);?>
                </td>
                </tr>
            <?php
                }
            }
            ?> 
        </tbody>
        
    </table>
    <?php
        }        
    ?>
</div>


<?php
    if(isset($_GET['action'])){
        $status = $_GET['action'];
        $idAction = $_GET['idAction'];
        $sql = "UPDATE users SET status ='$status' WHERE id = $idAction";
        $qUpdateStatus = mysqli_query($conn, $sql);
        echo "<script>window.alert('Success!');
        window.location.href = 'index.php?menu=manageuser';</script>";
    }

    function titleShow($s){
        switch($s){
            case "new":
                echo "New User";
                break;
            case "approved":
                echo "Approve User";
                break;
            case "rejected":
                echo "Reject User";
                break;
            default:
                echo "banned";
                break;
        }
    }

    function btnShow($status,$id){
        switch($status){
            case "new":
                echo "<a href='index.php?menu=manageuser&action=rejected&idAction=$id' class='btn btn-danger me-1'>Reject</a>";
                echo "<a href='index.php?menu=manageuser&action=approved&idAction=$id' class='btn btn-success'>Approve</a>";
                break;
            case "approved":
                echo "<a href='index.php?menu=manageuser&action=banned&idAction=$id' class='btn btn-danger'>Ban user</a>";
                break;
            case "rejected":
                echo "<a href='index.php?menu=manageuser&action=new&idAction=$id' class='btn btn-info text-light me-1'>Retry</a>";
                echo "<a href='index.php?menu=manageuser&action=approved&idAction=$id' class='btn btn-success'>Approve</a>";
                break;
            default:
                echo "<a href='index.php?menu=manageuser&action=approved&idAction=$id' class='btn btn-danger'>Un Ban</a>";
                break;
        }
    }
?>