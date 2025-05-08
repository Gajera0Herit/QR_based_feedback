<?php
include('includes/feedback-functions.php');
// $sql = "SELECT TE.t_name as t_name, TE.t_id as t_id FROM teachers TE where TE.t_id = " . $_GET['t_id'];
$sql = "SELECT t_name, sub_name
        FROM teachers  
        INNER JOIN teacher_subjects
        ON teacher_subjects.sub_id = " . $_GET['sub_id'];

$result = $conn->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

// if ($_SESSION["teacher_id"] == $row["t_id"])
//     $teacher_name = $row["t_name"];
// else
//     header("location: dashboard.php");

// if (!isset($_GET["t_id"])) {
//     header("location: dashboard.php");
// }

$sql1 = "SELECT s_id,s_name,s_email,s_phone from students where s_id = $login_session_id";
$student_data_for_values = $conn->query($sql1);
$row_for_student = $student_data_for_values->fetch_array(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="assets/js/app.js"></script>
    <title>VIT Feedback Form</title>
</head>

<body class="d-flex-center">
    <a class="kt-logout" href="logout.php">Logout</a>
    <div class="kt-title">Feedback Form for <?= $row['t_name'] . " on " . $row['sub_name']; ?> </div>
    <form class="kt-div" action="feedback.php?sub_id=<?= $_GET['sub_id']; ?>" method="POST">
        <!-- Error Box -->
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

        <div class="kt-sub-title">
            Please help us to teach you better by taking a couple of minutes.
        </div>
        <!-- Questions First Block -->
        <div class="kt-questions">
            <!-- First -->
            <div class="kt-question">
                <div class="kt-text">
                    Are you satisfied with the teaching staff and their teaching methods?
                </div>
                <div class="radiogroup">
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback1" id="a1" value="Highly Satisfied" />
                        <label class="label" for="a1">
                            <div class="indicator"></div>
                            <span class="text">Highly Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback1" id="b1" value="Satisfied" />
                        <label class="label" for="b1">
                            <div class="indicator"></div>
                            <span class="text">Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback1" id="c1" value="Neutral" />
                        <label class="label" for="c1">
                            <div class="indicator"></div>
                            <span class="text">Neutral</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback1" id="d1" value="Dissatisfied" />
                        <label class="label" for="d1">
                            <div class="indicator"></div>
                            <span class="text">Dissatisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback1" id="e1" value="Highly Dissatisfied" />
                        <label class="label" for="e1">
                            <div class="indicator"></div>
                            <span class="text">Highly Dissatisfied</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Second -->
            <div class="kt-question">
                <div class="kt-text">
                    How satisfied are you with the facilities provided by the college?
                </div>
                <div class="radiogroup">
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback2" id="a2" value="Highly Satisfied" />
                        <label class="label" for="a2">
                            <div class="indicator"></div>
                            <span class="text">Highly Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback2" id="b2" value="Satisfied" />
                        <label class="label" for="b2">
                            <div class="indicator"></div>
                            <span class="text">Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback2" id="c2" value="Neutral" />
                        <label class="label" for="c2">
                            <div class="indicator"></div>
                            <span class="text">Neutral</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback2" id="d2" value="Dissatisfied" />
                        <label class="label" for="d2">
                            <div class="indicator"></div>
                            <span class="text">Dissatisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback2" id="e2" value="Highly Dissatisfied" />
                        <label class="label" for="e2">
                            <div class="indicator"></div>
                            <span class="text">Highly Dissatisfied</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Questions First Block -->

        <!-- Questions Second Block -->
        <div class="kt-questions">
            <!-- First -->
            <div class="kt-question">
                <div class="kt-text">
                    Do you feel it is easier to register for different clubs within the college?
                </div>
                <div class="radiogroup">
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback3" id="a3" value="Highly Satisfied" />
                        <label class="label" for="a3">
                            <div class="indicator"></div>
                            <span class="text">Highly Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback3" id="b3" value="Satisfied" />
                        <label class="label" for="b3">
                            <div class="indicator"></div>
                            <span class="text">Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback3" id="c3" value="Neutral" />
                        <label class="label" for="c3">
                            <div class="indicator"></div>
                            <span class="text">Neutral</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback3" id="d3" value="Dissatisfied" />
                        <label class="label" for="d3">
                            <div class="indicator"></div>
                            <span class="text">Dissatisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback3" id="e3" value="Highly Dissatisfied" />
                        <label class="label" for="e3">
                            <div class="indicator"></div>
                            <span class="text">Highly Dissatisfied</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Second -->
            <div class="kt-question">
                <div class="kt-text">
                    Are you satisfied with the teaching staff and their teaching practices?
                </div>
                <div class="radiogroup">
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback4" id="a4" value="Highly Satisfied" />
                        <label class="label" for="a4">
                            <div class="indicator"></div>
                            <span class="text">Highly Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback4" id="b4" value="Satisfied" />
                        <label class="label" for="b4">
                            <div class="indicator"></div>
                            <span class="text">Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback4" id="c4" value="Neutral" />
                        <label class="label" for="c4">
                            <div class="indicator"></div>
                            <span class="text">Neutral</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback4" id="d4" value="Dissatisfied" />
                        <label class="label" for="d4">
                            <div class="indicator"></div>
                            <span class="text">Dissatisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback4" id="e4" value="Highly Dissatisfied" />
                        <label class="label" for="e4">
                            <div class="indicator"></div>
                            <span class="text">Highly Dissatisfied</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Questions Second Block -->

        <!-- Questions Third Block -->
        <div class="kt-questions">
            <!-- First -->
            <div class="kt-question">
                <div class="kt-text">
                    How satisfied are you with the cleanliness and variety of food items available in the cafeteria?
                </div>
                <div class="radiogroup">
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback5" id="a5" value="Highly Satisfied" />
                        <label class="label" for="a5">
                            <div class="indicator"></div>
                            <span class="text">Highly Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback5" id="b5" value="Satisfied" />
                        <label class="label" for="b5">
                            <div class="indicator"></div>
                            <span class="text">Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback5" id="c5" value="Neutral" />
                        <label class="label" for="c5">
                            <div class="indicator"></div>
                            <span class="text">Neutral</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback5" id="d5" value="Dissatisfied" />
                        <label class="label" for="d5">
                            <div class="indicator"></div>
                            <span class="text">Dissatisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback5" id="e5" value="Highly Dissatisfied" />
                        <label class="label" for="e5">
                            <div class="indicator"></div>
                            <span class="text">Highly Dissatisfied</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Second -->
            <div class="kt-question">
                <div class="kt-text">
                    How satisfied are you with the projects provided by the faculty?
                </div>
                <div class="radiogroup">
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback6" id="a6" value="Highly Satisfied" />
                        <label class="label" for="a6">
                            <div class="indicator"></div>
                            <span class="text">Highly Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback6" id="b6" value="Satisfied" />
                        <label class="label" for="b6">
                            <div class="indicator"></div>
                            <span class="text">Satisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback6" id="c6" value="Neutral" />
                        <label class="label" for="c6">
                            <div class="indicator"></div>
                            <span class="text">Neutral</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback6" id="d6" value="Dissatisfied" />
                        <label class="label" for="d6">
                            <div class="indicator"></div>
                            <span class="text">Dissatisfied</span>
                        </label>
                    </div>
                    <div class="wrapper">
                        <input class="state" type="radio" name="feedback6" id="e6" value="Highly Dissatisfied" />
                        <label class="label" for="e6">
                            <div class="indicator"></div>
                            <span class="text">Highly Dissatisfied</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Questions Third Block -->

        <div class="kt-text">
            If you have specific feedback, please write to us...
        </div>
        <textarea name="comment" id="scomment" placeholder="Additional Comments"></textarea>
        <div class="kt-input-fields">
            <div class="kt-name">
                <object type="image/svg+xml" data="assets/img/svg/user.svg"></object>
                <input type="text" name="sname" value='<?= $row_for_student['s_name']; ?>' disabled />
            </div>
        </div>
        <div class="kt-input-fields">
            <div class="kt-email">
                <object type="image/svg+xml" data="assets/img/svg/email.svg"></object>
                <input type="email" name="semail" value='<?= $row_for_student['s_email']; ?>' disabled />
            </div>
            <div class="kt-mobile">
                <object type="image/svg+xml" data="assets/img/svg/phone.svg"></object>
                <input type="text" name="sphone" value='<?= $row_for_student['s_phone']; ?>' disabled />
            </div>
        </div>
        <div class="kt-buttonWrapper">
            <button type="submit" name="submit_feedback" class="kt-button">Submit Feedback</button>
        </div>
    </form>
</body>

</html>