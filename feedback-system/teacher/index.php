<?php
session_start();
include("includes/functions.php");

if (isset($_SESSION['faculty_login'])) {
  header("location: dashboard.php");
}
/*

$errors = [];

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if (($username && $password) != "") {
        $sql = "SELECT id FROM admin_login WHERE username = '$username' and password = '$password'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($result->num_rows == 1) {
            $_SESSION['login_user'] = $username;
            header("location: dashboard.php");
            // echo $_SESSION['login_user'];
        } else {
            $error = "Invalid username or password!";
            array_push($errors, $error);
        }
    } else {
        $error = "Fields cannot be empty!";
        array_push($errors, $error);
    }
}*/
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, 
    initial-scale=1" />
  <link rel="stylesheet" href="../assets/css/style-login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../assets/js/app.js"></script>
  <title>Teacher's Portal</title>
</head>

<body>
  <div class="kt-div" style="width: 50%; ">
    <div class="kt-logo"></div>
    <div class="kt-title">Faculty's Portal</div>
    <div class="kt-button-group">
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>
</body>

</html>