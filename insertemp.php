<?php
define('PAGE','technician');
define('TITLE','insert Technician');
include('connect.php');
include('includes/header1.php');

session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aemail=$_SESSION['aemail'];
}
else{
    echo "<script> location.href='adminlogin.php' </script>";
}

// Ensure to include necessary files and initialize session as you did before

if(isset($_POST['empinsert'])){
    // Check for empty fields
    if( empty($_POST['empName']) || empty($_POST['empCity']) || empty($_POST['empMobile']) || empty($_POST['empEmail'])){
        $msg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        // Retrieve form data and sanitize
        $ename = $_POST['empName'];
        $eCity = $_POST['empCity'];
        $eMobile = $_POST['empMobile'];
        $eEmail = $_POST['empEmail'];
        $sql="INSERT INTO technician_tb(empName,empCity,empMobile,empEmail) VALUES ('$ename','$eCity','$eMobile','$eEmail')";
        if($conn->query($sql)==TRUE){
            $msg ='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Technician Added Succesfully</div>';
        }else{
            $msg ='<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Add</div>';

        }
       

        

        

    }
}
?>



<!--start 2nd column-->
<div class="col-sm-6 mx-3 jumbotron">
    <h3 class="text-center">Add New Technician</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="empName">Name</label>
            <input type="text" class="form-control" id="empName" name="empName">

        </div>
        <div class="form-group">
            <label for="empCity">City</label>
            <input type="text" class="form-control" id="empCity" name="empCity" >

        </div>
        <div class="form-group">
            <label for="empMobile">Mobile</label>
            <input type="text" class="form-control" id="empMobile" name="empMobile" >

        </div>
        <div class="form-group">
            <label for="empEmail">Email</label>
            <input type="text" class="form-control" id="empEmail" name="empEmail">

        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="empinsert" name="empinsert">Submit</button>
            <a href="technician.php">Close</a>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>

</div>



<?php
include('includes/footer1.php')
?>