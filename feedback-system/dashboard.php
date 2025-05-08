<?php
include('includes/dashboard-functions.php');

$sql = "SELECT sub_id, t_name, sub_name
        FROM teacher_subjects  
        INNER JOIN teachers  
        ON teacher_subjects.t_id=teachers.t_id 
        INNER JOIN  students  
        ON teacher_subjects.branch=students.s_branch 
        AND students.s_id = '$login_session_id'
        AND teacher_subjects.sub_year=students.s_year";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, 
    initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style-dashboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <title><?= $login_session_name; ?>'s Dashboard</title>
</head>

<body>
    <div class="kt-header-div">
        <a href="dashboard.php" class="kt-header-logo"></a>
        <div class="kt-header-navlinks">
            <!-- <a href="#">Dashboard</a>
        <a href="#">Something</a>
        <a href="#">Something</a> -->
        </div>
        <a class="kt-logout" href="logout.php">Logout</a>
    </div>
    <div class="kt-dashboard-div">
        <div class="kt-dashboard-title">Hello, <?= $login_session_name; ?>!</div>
        <div class="kt-dashboard-sub-title mt-20">Please give the feedback to the following teachers!</div>
        <table class="kt-dashboard-table">
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Subject</th>
                    <th>Feedback given?</th>
                    <th></th>
                </tr>
            </thead>
            <!-- <tbody>
                <tr>
                    <td>NA</td>
                    <td>NA</td>
                    <td>NA</td>
                </tr>
            </tbody> -->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["t_name"] . "</td>";
                    echo "<td>" . $row["sub_name"] . "</td>"; ?>
                    <td>
                        <?php
                        if (!empty($diff)) {
                            foreach ($diff as $value) {
                                if ($value == $row["sub_id"])
                                    echo "No";
                            }
                        } else {
                            // echo "No";
                            echo "Yes";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($diff)) {
                            foreach ($diff as $value) {
                                if ($value == $row["sub_id"]) {
                                    echo "<a href='feedback.php?sub_id=" . $row["sub_id"] . "' name='send' class='kt-button'>Give Feedback</a>";
                                }
                            }
                        } else {
                            // echo "<a href='feedback.php?sub_id=" . $row["sub_id"] . "' name='send' class='kt-button'>Give Feedback</a>";
                            echo "<a href='#' name='send' class='kt-button disabled'>Give Feedback</a>";
                        }
                        ?>
                    </td>
            <?php echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td>NA</td>";
                echo "<td>NA</td>";
                echo "<td>NA</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>