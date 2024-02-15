<?php
define('PAGE','dashboard');
define('TITLE','dashboard');
include('connect.php');


include('includes/header1.php');


session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aemail=$_SESSION['aemail'];
}
else{
    echo "<script> location.href='adminlogin.php' </script>";
}

$sql ="SELECT max(request_id) From submitrequest_tb";
$result=$conn->query($sql);
$row =$result->fetch_row();
$submitrequest=$row[0];

$sql ="SELECT max(rno) From assignwork_tb";
$result=$conn->query($sql);
$row =$result->fetch_row();
$assignwork=$row[0];


$sql ="SELECT * From technician_tb";
$result=$conn->query($sql);
$totaltech=$result->num_rows;



?>



 <div class="col-sm-9 col-md-10"><!-- start dashboard 2nd column-->
 <div class="row text-center mx-5 ">
    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-danger mb-3" style="max-width:18rem;">
            <div class="card-header">Requests Received </div>
            <div class="card-body">
            <h4 class="card-title"><?php echo $submitrequest; ?></h4>
            <a class="btn text-white" href="requests.php">View</a>
            </div>
        </div>
    </div>

    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-success mb-3" style="max-width:18rem;">
            <div class="card-header">Assigned Work</div>
            <div class="card-body">
            <h4 class="card-title"><?php echo $assignwork; ?></h4>
            <a class="btn text-white" href="work.php">View</a>
            </div>
        </div>
    </div>

    <div class="col-sm-4 mt-5">
        <div class="card text-white bg-info mb-3" style="max-width:18rem;">
            <div class="card-header">No. of Technicians </div>
            <div class="card-body">
            <h4 class="card-title"><?php echo $totaltech; ?></h4>
            <a class="btn text-white" href="technician.php">View</a>
            </div>
        </div>
    </div>
 </div>


 <div class="mx-5 mt-5 text-center">
    <p class="bg-dark text-white p-2">List Of Requesters</p>
    <?php
    $sql = "SELECT id,Username,Email FROM user_details";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table">
                <thead>
                    <tr>
                        <th scope="col">Requester Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['Username'] . '</td>
                    <td>' . $row['Email'] . '</td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "No data available";
    }
    ?>

 </div>
 </div><!-- end dashboard 2nd column-->
 <?php
include('includes/footer1.php');
 ?>
