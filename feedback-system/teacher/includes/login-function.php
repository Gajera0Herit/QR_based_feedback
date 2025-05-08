<?php
if (isset($_POST['login'])) {
    if (($_POST["email"] && $_POST["password"]) != "") {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        $sql = "SELECT * FROM teachers WHERE t_email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($result->num_rows == 1) {
            if (password_verify($password, $row["t_password"])) {
                //return true;  
                $_SESSION['teacher_login'] = $row["t_email"];
                header("location: dashboard.php");
            } else {
                //return false;  
                $error = "Invalid username or password!";
                array_push($errors, $error);
            }
        } else {
            $error = "Invalid username or password!";
            array_push($errors, $error);
        }
    } else {
        $error = "Fields cannot be empty!";
        array_push($errors, $error);
    }
}
