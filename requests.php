<?php
define('PAGE','requests');
define('TITLE','requests');
include('connect.php');
include('includes/header1.php');


session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aemail=$_SESSION['aemail'];
}
else{
    echo "<script> location.href='adminlogin.php' </script>";
}
?>

<!--start second column-->
<div class="col-sm-4 mb-5">
    <?php $sql="SELECT request_id,request_info,request_desc,request_date FROM submitrequest_tb";
    $result= $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '<div class="card mt-5 mx-5">';
            echo '<div class="card-header">';
            echo 'Request ID:'.$row['request_id'];
            echo '</div>';
            echo '<div class="card-body">';
        
           echo '<h5 class="card-title">Request Info: ' .$row['request_info'];
           echo '</h5>';

           echo '<p class="card-text">'.$row['request_desc'];
          echo  '</p>';

          echo '<p class="card-text">Request Date: '.$row['request_date'];
          echo  '</p>';
            
          echo '<div class="float-right">';
           echo '<form action="" method="POST">';
           echo '<input type="hidden" name="id" value='.$row["request_id"].'>';
          echo '<input type="submit" class="btn btn-primary mr-3" value="View" name="view">';
          echo '<input type="submit" class="btn btn-secondary" value="Close" name="close">';
          echo '</form>';
          echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div><!--end 2nd column-->


<?php
if(isset($_REQUEST['view'])){
  $sql ="SELECT * FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
}

if(isset($_REQUEST['close'])){
    $sql="DELETE FROM submitrequest_tb WHERE request_id= {$_REQUEST['id']}";
    if($conn->query($sql) == TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
    }
    else{
        echo "unable to delete";
    }
    } 
if(isset($_REQUEST['assign'])){
    if(($_REQUEST['request_id'] == "") || ($_REQUEST['request_info'] == "") ||($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['address1'] == "") || ($_REQUEST['address2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['assigntech'] == "") || ($_REQUEST['inputdate'] == "")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2 text-center">Fill ALL the Fields</div>';
    }
    else{
        $rid=$_REQUEST['request_id'];
        $rinfo=$_REQUEST['request_info'];
        $rdesc=$_REQUEST['requestdesc'];
        $rname=$_REQUEST['requestername'];
        $radd1=$_REQUEST['address1'];
        $radd2=$_REQUEST['address2'];
        $rcity=$_REQUEST['requestercity'];
        $rstate=$_REQUEST['requesterstate'];
        $rzip=$_REQUEST['requesterzip'];
        $remail=$_REQUEST['requesteremail'];
        $rmobile=$_REQUEST['requestermobile'];
        $rassigntech=$_REQUEST['assigntech'];
        $rdate=$_REQUEST['inputdate'];
        $sql= "INSERT INTO assignwork_tb(request_id,request_info,request_desc ,requester_name,requester_add1,requester_add2,requester_city,requester_state,requester_zip,requester_email,requester_mobile,assign_tech,assign_date) VALUES ('$rid' , '$rinfo' ,'$rdesc' ,'$rname' ,'$radd1' ,'$radd2' ,'$rcity' ,'$rstate' ,'$rzip' ,'$remail' ,'$rmobile' ,'$rassigntech' ,'$rdate')";
        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2 text-center">Work Assigned Successfully!</div>';
        }
        else{
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2 text-center">Unable To Assign Work.</div>';
        }
    }
}
?>



<div class="col-sm-5  mt-5 jumbotron"><!--start assigned work 3rd column-->
<form  action="" method="POST">
    <h5 class="text-center">Assign work order Request</h5>
    <?php if(isset($msg)){echo $msg ;} ?>
    <div class="form-group">
        <label for="request_id">Request Id</label>
        <input type="text" class="form-control" id="request_id"  name="request_id" value= "<?php  if(isset($row['request_id'])) echo $row['request_id']; ?>" readonly>
    </div>


    <div class="form-group">
        <label for="request_info">Request Info</label>
        <input type="text" class="form-control" id="request_info" name="request_info" value= "<?php  if(isset($row['request_info'])) echo $row['request_info']; ?>" >
    </div>

    <div class="form-group">
        <label for="requestdesc">Description</label></label>
        <input type="text" class="form-control" id="requestdesc" name="requestdesc"  value= "<?php  if(isset($row['request_desc'])) echo $row['request_desc']; ?>">
    </div>

    <div class="form-group">
        <label for="requestername">Name</label>
        <input type="text" class="form-control" id="requestername" name="requestername" value= "<?php  if(isset($row['requester_name'])) echo $row['requester_name']; ?>">
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="address1">Adress Line 1</label>
        <input type="text" class="form-control" id="address1" name="address1" value= "<?php  if(isset($row['requester_add1'])) echo $row['requester_add1']; ?>">
    </div>

    <div class="form-group col-md-6">
        <label for="address2">Adress Line 2</label>
        <input type="text" class="form-control" id="address2" name="address2" value= "<?php  if(isset($row['requester_add2'])) echo $row['requester_add2']; ?>">
    </div>
    </div>

    <div class="form-row">
    <div class="form-group col-md-4">
        <label for="requestercity">City</label>
        <input type="text" class="form-control" id="requestercity" name="requestercity" value= "<?php  if(isset($row['requester_city'])) echo $row['requester_city']; ?>">
    </div>
    <div class="form-group col-md-4">
        <label for="requesterstate">State</label>
        <input type="text" class="form-control" id="requesterstate" name="requesterstate" value= "<?php  if(isset($row['requester_state'])) echo $row['requester_state']; ?>">
    </div>
    <div class="form-group col-md-4">
        <label for="requesterzip">Zip</label>
        <input type="text" class="form-control" id="requesterzip"  name="requesterzip"  value= "<?php  if(isset($row['requester_zip'])) echo $row['requester_zip']; ?>" onkeypress="isInputNumber(event)">
    </div>
    </div>

    <div class="form-row">
    <div class="form-group col-md-8">
        <label for="requesteremail">Email Id</label>
        <input type="email" class="form-control" id="requesteremail" name="requesteremail" value= "<?php  if(isset($row['requester_email'])) echo $row['requester_email']; ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="requestermobile">Mobile No.</label>
        <input type="text" class="form-control" id="requestermobile"  name="requestermobile" value= "<?php  if(isset($row['requester_mobile'])) echo $row['requester_mobile']; ?>"  onkeypress="isInputNumber(event)">
    </div>

    
    </div>


    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="assigntech">Assign to technician</label>
            <input type="text" class="form-control" id="assigntech" name="assigntech">
        </div>
        <div class="form-group col-md-6">
            <label for="inputdate">Date</label>
            <input type="date" class="form-control" id="inputdate" name="inputdate">
        </div>
    </div>
    <div class="float-right">
    <button type="submit" class="btn btn-success" name="assign">Assign</button>
    <button type="reset" class="btn  btn-secondary">Reset</button>
    

    </div>
</form>


</div>



<?php
include('includes/footer1.php')
?>