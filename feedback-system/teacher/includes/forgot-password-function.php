<?php

if (isset($_POST['forgot-password'])) {
    if (($_POST["email"] && $_POST["phone"]) != "") {
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $sql = "SELECT * FROM teachers WHERE t_email = '$email' AND t_phone = '$phone'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($result->num_rows == 1) {
            $_SESSION['reset_token'] = $row["t_id"];
            header("location: reset-password.php");
        } else {
            $error = "Invalid details!";
            array_push($errors, $error);
        }
    } else {
        $error = "Fields cannot be empty!";
        array_push($errors, $error);
    }
}
