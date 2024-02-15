<?php
define('PAGE','requester');
define('TITLE','insert Requester');
include('userconnect.php');
include('includes/header1.php');

session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aemail=$_SESSION['aemail'];
}
else{
    echo "<script> location.href='adminlogin.php' </script>";
}

// Ensure to include necessary files and initialize session as you did before

if(isset($_POST['reqsubmit'])){
    // Check for empty fields
    if( empty($_POST['Username']) || empty($_POST['Phone']) || empty($_POST['Email']) || empty($_POST['Password']) || empty($_POST['Cpassword'])){
        $msg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        // Retrieve form data and sanitize
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $password = $_POST['Password'];
        $cpassword = $_POST['Cpassword'];

        // Password hashing
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

        // Check if email already exists
        $emailquery = "SELECT * FROM user_details WHERE Email=?";
        $stmt = $con->prepare($emailquery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $emailcount = $result->num_rows;
        $stmt->close();

        if($emailcount > 0){
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Email Already Exists!</div>';
        } else {
            if($password === $cpassword){
                // Insert user details into the database
                $insertquery = "INSERT INTO user_details (Username, Email, Phone, Password, Cpassword, Token, Status) VALUES ('$username','$email','$phone', '$password', '$cpassword','token', 'inactive')";
                $stmt = $con->prepare($insertquery);
                $stmt->bind_param("ssssss", $username, $email, $phone, $pass, $cpass, $token);
                $token = bin2hex(random_bytes(15)); // Generate random token
                $stmt->execute();
                $stmt->close();

                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Record Added Successfully</div>';
            } else {
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Passwords do not match!</div>';
            }
        }
    }
}
?>


?>

<!--start 2nd column-->
<div class="col-sm-6 mx-3 jumbotron">
    <h3 class="text-center">Add New User</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" class="form-control" id="Username" name="Username">

        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" class="form-control" id="Email" name="Email">

        </div>
        <div class="form-group">
            <label for="Phone">Phone</label>
            <input type="text" class="form-control" id="Phone" name="Phone">

        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="text" class="form-control" id="Password" name="Password">

        </div>
        <div class="form-group">
            <label for="Cpassword">Confirm Password</label>
            <input type="text" class="form-control" id="Cpassword" name="Cpassword">

        </div>
        <div>
            <button type="submit" class="btn btn-danger" id="reqsubmit" name="reqsubmit">Submit</button>
            <a href="requester.php">Close</a>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>

</div>



<?php
include('includes/footer1.php')
?>