<?php
define('PAGE','requester');
define('TITLE','requester');
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

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <p class="bg-dark text-white p-2">List Of Requesters</p>
    <?php $sql="SELECT *FROM user_details ";
    $result =$conn->query($sql);
    if($result->num_rows>0){
        echo '<table class="table">';
         echo '<thead>';
          echo '<tr>';
           echo '<th scope="col">Requester ID</th>';
           echo '<th scope="col">Name</th>';
           echo '<th scope="col">Email</th>';
           echo '<th scope="col">Phone</th>';
           echo '<th scope="col">Action</th>';
          echo '</tr>';
         echo '</thead>';
        echo '<tbody>';
         while($row=$result->fetch_assoc()){
            echo '<tr>';
             echo '<td>'.$row["id"].'</td>';
             echo '<td>'.$row["Username"].'</td>';
             echo '<td>'.$row["Email"].'</td>';
             echo '<td>'.$row["Phone"].'</td>';
             echo '<td>';
              echo '<form action="editreq.php" method="POST" class="d-inline" >';
               echo '<input type="hidden" name="id" value='.$row["id"].'><button type="submit" class="btn btn-info mr-3" name="edit" values="Edit"><i class="fas fa-pen"></i></button>';
              echo '</form>';
              echo '<form action="" method="POST" class="d-inline" >';
               echo '<input type="hidden" name="id" value='.$row["id"].'><button type="submit" class="btn btn-secondary mr-3" name="delete" values="delete"><i class="far fa-trash-alt"></i></button>';
              echo '</form>';
             echo '</td>';
            echo '</tr>';
         }
        echo '</tbody>';
        
        echo '</table>';

    } else{
        echo ' No Record Found';
    } 
    ?>
</div>


<?php 
if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM user_details WHERE id={$_REQUEST['id']}";
    if($conn->query($sql)==TRUE){
        echo '<meta http-equiv="refresh" content= "0:UPL=?deleted />';

    }else{
        echo 'Unable to Delete';
    }
}


?>



</div><!--end row-->
<div class ="float-right"><a href="insertreq.php" class="btn btn-danger"><i class="fas fa-plus fa-2x"></i></a></div>
</div><!--end container-->



    








    <!--javascript-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script>
</body>
</html>


    





