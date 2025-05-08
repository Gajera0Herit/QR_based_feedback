<?php
include('includes/session.php');

//Feedback count
$sql = "SELECT count(t_id) as t_count FROM student_feedback WHERE t_id = " . $login_session_id;
$result = $conn->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['add_subject'])) {
    if (($_POST["branch"] && $_POST["year"] && $_POST["subject"]) != "") {
        $branch = $conn->real_escape_string($_POST["branch"]);
        $year = $conn->real_escape_string($_POST["year"]);
        $subject = $conn->real_escape_string($_POST["subject"]);

        if (
            $branch != "Mechanical Engineering" &&
            $branch != "E & TC Engineering" &&
            $branch != "Production Engineering" &&
            $branch != "Computer Engineering" &&
            $branch != "Information Technology" &&
            $branch != "MCA"
        ) {
            $error = "Enter a valid branch!<br>eg; Mechanical Engineering, Production Engineering, MCA, etc.";
            array_push($errors, $error);
        }

        if (
            $year != "First" &&
            $year != "Second" &&
            $year != "Third" &&
            $year != "Fourth"
        ) {
            $error = "Enter a valid year!<br>eg; First, Second, Third, Fourth";
            array_push($errors, $error);
        }

        if (($branch == "MCA" && $year == "Third") || ($branch == "MCA" && $year == "Fourth")) {
            $error = "MCA has only First and Second year!";
            array_push($errors, $error);
        }

        if (empty($errors)) {
            $subject_exists = $conn->query("SELECT * FROM teacher_subjects 
                WHERE t_id = $login_session_id 
                AND branch = '$branch' 
                AND sub_year = '$year' 
                AND sub_name = '$subject' 
                ");

            if ($subject_exists->num_rows > 0) {
                $error = "You already have this subject!";
                array_push($errors, $error);
            } else {
                $sql = "INSERT INTO teacher_subjects (t_id, branch, sub_year, sub_name) VALUES ($login_session_id , '$branch', '$year', '$subject')";

                if ($conn->query($sql)) {
                    header("location: dashboard.php?success=1");
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
