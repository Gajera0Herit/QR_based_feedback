<?php

if (isset($_POST['forgot-password'])) {
    if (($_POST["email"] && $_POST["branch"] && $_POST["year"]) != "") {
        $email = $conn->real_escape_string($_POST['email']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $year = $conn->real_escape_string($_POST['year']);

        $sql = "SELECT * FROM students WHERE s_email = '$email' AND s_branch = '$branch' AND s_year = '$year'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($result->num_rows == 1) {
            $_SESSION['reset_token'] = $row["s_id"];
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
