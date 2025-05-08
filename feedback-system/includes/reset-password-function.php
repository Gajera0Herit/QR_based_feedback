<?php

if (isset($_POST['reset-password'])) {
    if (($_POST["password"] && $_POST["cpassword"]) != "") {
        $password = $conn->real_escape_string($_POST['password']);
        $cpassword = $conn->real_escape_string($_POST['cpassword']);

        if ($password != $cpassword) {
            $error = "Password do not match!";
            array_push($errors, $error);
        }
        if (strlen($password) < 6) {
            $error = "Password too short!";
            array_push($errors, $error);
        }
        if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/', $password)) {
            $error = "Password should atleast one lowercase character, one uppercase character, one digit and one special character!";
            array_push($errors, $error);
        }

        if (empty($errors)) {
            $options = [
                'cost' => 9
            ];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

            $sql = "UPDATE students SET s_password='$hashed_password' WHERE s_id ='" . $_SESSION['reset_token'] . "'";

            if ($conn->query($sql)) {
                header("location: login.php?success=2");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $error = "Fields cannot be empty!";
        array_push($errors, $error);
    }
}
