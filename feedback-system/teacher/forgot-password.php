<?php
session_start();
include("includes/functions.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, 
    initial-scale=1" />
    <link rel="stylesheet" href="../assets/css/style-forgot.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <title>Forgot password</title>
</head>

<body>
    <div class="kt-div">
        <div class="kt-logo"></div>
        <div class="kt-title">Forgot password</div>

        <form method="POST" action="forgot-password.php" class="kt-input-fields">
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
            <div class="kt-email">
                <object type="image/svg+xml" data="../assets/img/svg/email.svg"></object>
                <input type="email" placeholder="Enter VIT.EDU Email" name="email" />
            </div>
            <div class="kt-phone">
                <object type="image/svg+xml" data="../assets/img/svg/phone.svg"></object>
                <input type="text" placeholder="Enter your phone number" name="phone" />
            </div>

            <button type="submit" name="forgot-password" class="kt-button">
                Forgot Password</button>

            <div class="kt-link"><a href="login.php">
                    Login</a> or
                <a href="register.php">Register</a>
            </div>
        </form>
</body>

</html>