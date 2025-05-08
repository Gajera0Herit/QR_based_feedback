<?php
include("../includes/connection.php");
session_start();

if (isset($_SESSION['admin_login'])) {
    header("location: dashboard.php");
}

$errors = [];

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if (($username && $password) != "") {
        $sql = "SELECT * FROM admin WHERE a_username = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($result->num_rows == 1) {
            if (password_verify($password, $row["a_password"])) {
                //return true;  
                $_SESSION['admin_login'] = $username;
                header("location: dashboard.php");
            } else {
                //return false;  
                $error = "Invalid username or password!";
                array_push($errors, $error);
            }
            // echo $_SESSION['admin_login'];
        } else {
            $error = "Invalid username or password!";
            array_push($errors, $error);
        }
    } else {
        $error = "Fields cannot be empty!";
        array_push($errors, $error);
    }
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
    <link rel="stylesheet" href="style.css">
    <script src="../assets/js/app.js"></script>
    <title>Admin Login</title>
</head>

<body>
    <div class="kt-div">
        <div class="kt-logo"></div>
        <div class="kt-title">Admin Login</div>

        <form method="POST" action="index.php" class="kt-input-fields">
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
            <div class="kt-username">
                <object type="image/svg+xml" data="../assets/img/svg/user.svg"></object>
                <input type="username" placeholder="Enter Username" name="username" />
            </div>
            <div class="kt-password">
                <object type="image/svg+xml" data="../assets/img/svg/password.svg"></object>
                <input type="password" placeholder="Enter Password" name="password" />
            </div>
            <button type="submit" name="login" class="kt-button">
                Login</button>
        </form>
</body>

</html>