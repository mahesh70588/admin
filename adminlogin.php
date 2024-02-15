<?php
include('connect.php');
session_start();

$msg = ''; // Initialize the message variable

if(isset($_REQUEST['aemail'])) {
    $aemail = mysqli_real_escape_string($conn, trim($_REQUEST['aemail']));
    $apassword = mysqli_real_escape_string($conn, trim($_REQUEST['apassword']));

    $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email='".$aemail."' AND a_password='".$apassword."' Limit 1";
    $result = $conn->query($sql);

    if($result && $result->num_rows == 1) {
        $_SESSION['is_adminlogin'] = true;
        $_SESSION['aemail'] = $aemail;
        echo "<script> location.href='dashboard.php';</script>";
        exit;
    } else {
        $msg = '<div class="alert alert-warning mt-2">Enter valid email and password</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">

    <style>
        .custom-margin {
            margin-top: 8vh;
        }
    </style>

    <title>LOGIN</title>
</head>
<body>
    <div class="mb-3 mt-5 text-center" style="font-size:30px;">
        <i class="fas fa-stethoscope"></i>
        <span>Admin Login</span>
    </div>
    <p class="text-center" style="font-size:20px;">
        <i class="fas fa-user-secret text-danger"></i>Admin Area
    </p>
    <div class="container-fluid">
        <div class="row justify-content-center custom-margin">
            <div class="col-sm-6 col-md-4">
                <!-- Display error message if set -->
                <?php if(!empty($msg)) { echo $msg; } ?>

                <!-- Login form -->
                <form action="" class="shadow-lg p-4" method="post">
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <label for="email" class="font-weight-bold pl-2">Email</label>
                        <input type="email" class="form-control" placeholder="email" name="aemail">
                        <small class="form-text">We will never share your email with anyone else.</small>
                    </div>
                    <div class="form-group mt-3">
                        <i class="fas fa-key"></i>
                        <label for="pass" class="font-weight-bold pl-2">Password</label>
                        <input type="password" class="form-control" placeholder="password" name="apassword">
                    </div>
                    <button type="submit" class="btn btn-outline-danger mt-3 font-weight-bold btn-block shadow-sm">Login</button>
                </form>

                <!-- Back to Home link -->
                <div class="text-center">
                    <a href="index.php" class="btn btn-info mt-3 font-weight-bold shadow-sm">Back To Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>
