<?php
session_start();
include("includes/functions.php");

if (!isset($_SESSION['reset_token'])) {
    header("location: index.php");
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
    <link rel="stylesheet" href="../assets/css/style-forgot.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <title>Reset password</title>
</head>

<body>
    <div class="kt-div">
        <div class="kt-logo"></div>
        <div class="kt-title">Reset password</div>

        <form method="POST" action="reset-password.php" class="kt-input-fields">
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
            <div class="kt-password">
                <object type="image/svg+xml" data="../assets/img/svg/password.svg"></object>
                <input type="password" placeholder="Enter Password" name="password" />
            </div>
            <div class="kt-password">
                <object type="image/svg+xml" data="../assets/img/svg/password.svg"></object>
                <input type="password" placeholder="Confirm Password" name="cpassword" />
            </div>
            <button type="submit" name="reset-password" class="kt-button">
                Reset Password</button>
        </form>
</body>

</html>