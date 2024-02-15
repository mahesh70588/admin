<?php
session_start();
define('PAGE','technician');
define('TITLE','Update Technician');
include('connect.php');
include('includes/header1.php');


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
        $sql=  "SELECT * FROM technician_tb WHERE emp_id ={$_REQUEST['id']}";
        $result=$conn->query($sql);
        $row =$result->fetch_assoc();
        

    }
    if(isset($_REQUEST['empupdate'])){
        if(($_REQUEST['emp_id']=="") || ($_REQUEST['empName']=="")||($_REQUEST['empCity']=="")||($_REQUEST['empMobile']=="")|($_REQUEST['empEmail']=="")){
            $msg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
        }else{
            $eid =$_REQUEST['emp_id'];
            $eName =$_REQUEST['empName'];
            $eCity =$_REQUEST['empCity'];
            $eMobile =$_REQUEST['empMobile'];
            $eEmail =$_REQUEST['empEmail'];
            $sql= "UPDATE technician_tb SET empName='$eName',empCity='$eCity',empMobile='$eMobile',empEmail='$eEmail' WHERE emp_id= '$eid'";
            if($conn->query($sql)==TRUE){
                $msg='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Record Updated Successfully</div>';
                echo "<script> location.href='technician.php' </script>";


            }else{
                $msg='<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
            }
        }
        
    }
    
    
    
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="emp_id">Emp ID</label>
            <input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php if(isset($row['emp_id']))
            {echo $row['emp_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="empName">Name</label>
            <input type="text" class="form-control" name="empName" id="empName" value="<?php if(isset($row['empName']))
            {echo $row['empName'];} ?>" >
        </div>
        <div class="form-group">
            <label for="empCity">City</label>
            <input type="text" class="form-control" name="empCity" id="empCity" value="<?php if(isset($row['empCity']))
            {echo $row['empCity'];} ?>" >
        </div>
        <div class="form-group">
            <label for="empMobile">Mobile No</label>
            <input type="text" class="form-control" name="empMobile" id="empMobile" value="<?php if(isset($row['empMobile']))
            {echo $row['empMobile'];} ?>" >
        </div>
        <div class="form-group">
            <label for="empEmail">Email</label>
            <input type="text" class="form-control" name="empEmail" id="empEmail" value="<?php if(isset($row['empEmail']))
            {echo $row['empEmail'];} ?>" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate">Update </button>
            <a href="technician.php" class="btn btn-secondary">Close</a>
        </div>

        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>

</div><!--column 2nd end-->




<?php
include('includes/footer1.php')
?>