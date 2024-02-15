<?php
define('PAGE','requester');
define('TITLE','Update Requester');
include('userconnect.php');
include('includes/header1.php');

session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aemail=$_SESSION['aemail'];
}
else{
    echo "<script> location.href='adminlogin.php' </script>";
}

?>

<!-- start second column-->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Requester Details</h3>
    <?php  
    if(isset($_REQUEST['edit'])){
        $sql=  "SELECT * FROM user_details WHERE id ={$_REQUEST['id']}";
        $result=$conn->query($sql);
        $row =$result->fetch_assoc();
        

    }
    if(isset($_REQUEST['requpdate'])){
        if(($_REQUEST['id']=="") || ($_REQUEST['Username']=="")||($_REQUEST['Phone']=="")||($_REQUEST['Email']=="")){
            $msg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
        }else{
            $rid =$_REQUEST['id'];
            $rname =$_REQUEST['Username'];
            $remail =$_REQUEST['Email'];
            $rphone =$_REQUEST['Phone'];
            $sql= "UPDATE user_details SET id='$rid',Username='$rname',Email='$remail',Phone='$rphone' WHERE id= '$rid'";
            if($conn->query($sql)==TRUE){
                $msg='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Record Updated Successfully</div>';

            }else{
                $msg='<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
            }
        }
        
    }
    
    
    
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="id">Requester ID</label>
            <input type="text" class="form-control" name="id" id="id" value="<?php if(isset($row['id']))
            {echo $row['id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="Username">Name</label>
            <input type="text" class="form-control" name="Username" id="Username" value="<?php if(isset($row['Username']))
            {echo $row['Username'];} ?>" >
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" class="form-control" name="Email" id="Email" value="<?php if(isset($row['Email']))
            {echo $row['Email'];} ?>" >
        </div>
        <div class="form-group">
            <label for="Phone">Mobile No</label>
            <input type="text" class="form-control" name="Phone" id="Phone" value="<?php if(isset($row['Phone']))
            {echo $row['Phone'];} ?>" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update </button>
            <a href="requester.php" class="btn btn-secondary">Close</a>
        </div>

        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>

</div><!--column 2nd end-->




<?php
include('includes/footer1.php')
?>