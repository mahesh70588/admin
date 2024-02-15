<?php
session_start();
define('PAGE','assets');
define('TITLE','Assets');
include('connect.php');
include('includes/header1.php');
if(isset($_SESSION['is_adminlogin'])){
    $aemail=$_SESSION['aemail'];
}
else{
    echo "<script> location.href='adminlogin.php' </script>";
}
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
    <p class="bg-dark text-white p-2">Products Details</p>
    <?php $sql="SELECT *FROM assets_tb ";
    $result =$conn->query($sql);
    if($result->num_rows>0){
        echo '<table class="table">';
         echo '<thead>';
          echo '<tr>';
           echo '<th scope="col">Product Id</th>';
           echo '<th scope="col">Name</th>';
           echo '<th scope="col">DOP</th>';
           echo '<th scope="col">Available</th>';
           echo '<th scope="col">Total</th>';
           echo '<th scope="col">Original Cost Each</th>';
           echo '<th scope="col">Selling Cost Each</th>';
           echo '<th scope="col">Action</th>';
          echo '</tr>';
         echo '</thead>';
        echo '<tbody>';
         while($row=$result->fetch_assoc()){
            echo '<tr>';
             echo '<td>'.$row["pid"].'</td>';
             echo '<td>'.$row["pname"].'</td>';
             echo '<td>'.$row["pdop"].'</td>';
             echo '<td>'.$row["pava"].'</td>';
             echo '<td>'.$row["ptotal"].'</td>';
             echo '<td>'.$row["poriginalcost"].'</td>';
             echo '<td>'.$row["psellingcost"].'</td>';
             echo '<td>';
              echo '<form action="editproduct.php" method="POST" class="d-inline" >';
               echo '<input type="hidden" name="id" value='.$row["pid"].'><button type="submit" class="btn btn-info mr-3" name="edit" values="Edit"><i class="fas fa-pen"></i></button>';
              echo '</form>';
              echo '<form action="" method="POST" class="d-inline" >';
               echo '<input type="hidden" name="id" value='.$row["pid"].'><button type="submit" class="btn btn-secondary mr-3" name="delete" values="delete"><i class="far fa-trash-alt"></i></button>';
              echo '</form>';
              echo '<form action="sellproduct.php" method="POST" class="d-inline" >';
               echo '<input type="hidden" name="id" value='.$row["pid"].'><button type="submit" class="btn btn-warning mr-3" name="issue" values="Issue"><i class="fas fa-handshake"></i></button>';
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
    $sql = "DELETE FROM assets_tb WHERE pid={$_REQUEST['id']}";
    if($conn->query($sql)==TRUE){
        echo '<meta http-equiv="refresh" content= "0:UPL=?deleted />';
        echo "<script> location.href='assets.php' </script>";

    }else{
        echo 'Unable to Delete';
    }
}


?>



</div><!--end row-->
<div class ="float-right"><a href="addproduct.php" class="btn btn-danger"><i class="fas fa-plus fa-2x"></i></a></div>
</div><!--end container-->



    








    <!--javascript-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script>
</body>
</html>








<?php
include('includes/footer1.php')
?>