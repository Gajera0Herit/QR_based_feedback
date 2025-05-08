<?php
session_start();
include("includes/functions.php");

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
    <link rel="stylesheet" href="../assets/css/style-reg.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <title>Teacher Registration</title>
</head>

<body>
    <div class="kt-div">
        <div class="kt-logo"></div>
        <div class="kt-title">Teacher Registration</div>

        <form method="POST" action="register.php" class="kt-form">
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
            <div class="kt-input-block">
                <div class="kt-name" style="margin-right: 20px;">
                    <object type="image/svg+xml" data="../assets/img/svg/user.svg"></object>
                    <input type="text" placeholder="Enter Name" name="name" />
                </div>
                <div class="kt-email">
                    <object type="image/svg+xml" data="../assets/img/svg/email.svg"></object>
                    <input type="email" placeholder="Enter Email" name="email" />
                </div>
            </div>

            <div class="kt-input-block">
                <div class="kt-password" style="margin-right: 20px;">
                    <object type="image/svg+xml" data="../assets/img/svg/password.svg"></object>
                    <input type="password" placeholder="Enter Password" name="password" />
                </div>
                <div class="kt-phone">
                    <object type="image/svg+xml" data="../assets/img/svg/phone.svg"></object>
                    <input type="text" placeholder="Enter Phone Number" name="phone" />
                </div>
            </div>

            <button type="submit" name="register" class="kt-button">
                Register</button>
            <div class="kt-link">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </form>
</body>

</html>