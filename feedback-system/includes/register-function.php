<?php

//Registering a student
if (isset($_POST['register'])) {
    if (($_POST["name"] && $_POST["email"] && $_POST["password"] && $_POST["phone"]) != "" && isset($_POST['branch']) && isset($_POST['year'])) {
        //Initializing variables
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $password = $conn->real_escape_string($_POST["password"]);
        $phone = $conn->real_escape_string($_POST["phone"]);
        $branch = $conn->real_escape_string($_POST["branch"]);
        $year = $conn->real_escape_string($_POST["year"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Enter a valid email!";
            array_push($errors, $error);
        }
        if (!preg_match("/^[6-9]\d{9}$/", $phone)) {
            $error = "Enter a valid mobile number!";
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

            $result = $conn->query("SELECT * FROM students WHERE s_email = '$email'");

            if ($result->num_rows > 0) {
                $error = "You have already registered using $email!";
                array_push($errors, $error);
            } else {
                $sql = "INSERT INTO students (s_name, s_email, s_password, s_phone, s_branch, s_year) VALUES ('$name', '$email', '$hashed_password', '$phone', '$branch', '$year')";

                if ($conn->query($sql)) {
                    header("location: login.php?success=1");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    } else {
        $error = "Fields cannot be empty!";
        array_push($errors, $error);
    }
}