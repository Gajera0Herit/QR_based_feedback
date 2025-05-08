<?php
session_start();
include("includes/functions.php");

if (isset($_GET["success"])) {
    if ($_GET["success"] == 1) {
        $_SESSION["success"] = "You have successfully registered! <br> Please login to continue!";
    }
    if ($_GET["success"] == 2) {
        unset($_SESSION['reset_token']);
        $_SESSION["success"] = "You have successfully reset your password!";
    }
} else {
    $_SESSION["success"] = "";
}

if (isset($_SESSION['teacher_login'])) {
    header("location: dashboard.php");
}
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
    <title>Teacher Login</title>
</head>

<body>
    <div class="kt-div">
        <div class="kt-logo"></div>
        <div class="kt-title">Faculty Login</div>

        <form method="POST" action="login.php" class="kt-input-fields">
            <div class="error-box" style="display: <?php echo (!empty($errors)) ? "block" : "none"; ?>">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $key => $value) {
                        echo $value . "<br>";
                    }
                } else {
                    echo "";
                }
                ?>
            </div>
            <div class="success-box" style="display: <?php echo ($_SESSION["success"] != "") ? "block" : "none"; ?>">
                <?= $_SESSION["success"]; ?>
            </div>
            <div class="kt-email">
                <object type="image/svg+xml" data="../assets/img/svg/email.svg"></object>
                <input type="email" placeholder="Enter Email" name="email" />
            </div>
            <div class="kt-password">
                <object type="image/svg+xml" data="../assets/img/svg/password.svg"></object>
                <input type="password" placeholder="Enter Password" name="password" />
            </div>
            <button type="submit" name="login" class="kt-button">
                Login</button>
            <div class="kt-link"><a href="forgot-password.php">
                    Forgot password?</a> or
                <a href="register.php">Register</a></div>
        </form>
</body>

</html>