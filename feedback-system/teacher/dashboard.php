<?php
include('includes/dashboard-functions.php');

$teacher_sql = "SELECT * FROM teacher_subjects WHERE t_id = $login_session_id";
$teacher_result = $conn->query($teacher_sql);

if (isset($_GET["success"])) {
    if ($_GET["success"] == 1) {
        $_SESSION["success"] = "You have successfully added the subject!";
    }
} else {
    $_SESSION["success"] = "";
}

if (isset($_GET['delete_id'])) {
    $_SESSION["delete_id"] = $_GET['delete_id'];

    $sql = "DELETE FROM teacher_subjects WHERE sub_id='" . $_SESSION["delete_id"] . "'";

    if ($conn->query($sql)) {
        $page = $_SERVER['PHP_SELF'];
        $sec = "1";

        echo "<script>alert('Feedback deleted successfully!');</script>";
        header("Refresh: $sec; url=$page");
    } else {
        echo "Error deleting record: " . $conn->error;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style-dashboard.css">
    <link rel="stylesheet" href="../assets/css/addon.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <title><?= $login_session_name; ?>'s Dashboard</title>
    <style>
        /* Additional styles for the dropdowns */
        .kt-year select, .kt-branch select {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 16px;
            padding: 10px 0;
        }
    </style>
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
        <div class="kt-dashboard-sub-title mt-40">You have received total <span class="kt-dashboard-title error-red"><?= $row['t_count'] ?> </span>feedback/s!</div>
        <div class="kt-dashboard-sub-title mt-20">Following are the subjects you are teaching</div>

        <table class="kt-dashboard-table">
            <thead>
                <tr>
                    <th>Branch</th>
                    <th>Year</th>
                    <th>Subject</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($teacher_result->num_rows > 0) {
                    while ($teacher_row = $teacher_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $teacher_row['branch'] . "</td>";
                        echo "<td>" . $teacher_row['sub_year'] . "</td>";
                        echo "<td>" . $teacher_row['sub_name'] . "</td>";
                        echo "<td><a href='dashboard.php?delete_id=" . $teacher_row['sub_id'] . "' class='kt-delete-button'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="kt-dashboard-div">
        <div class="kt-dashboard-title">Add new subject</div>
        <form method="POST" action="dashboard.php" class="kt-form">
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
            <div class="success-box" style="display: <?php echo ($_SESSION["success"] != "") ? "block" : "none"; ?>">
                <?= $_SESSION["success"]; ?>
            </div>
            <div class="kt-input-block">
                <div class="kt-branch" style="margin-right: 20px;">
                    <object type="image/svg+xml" data="../assets/img/svg/branch.svg"></object>
                    <select name="branch">
                        <option value="" disabled selected>Select Branch</option>
                        <option value="Computer Engineering">Computer Engineering</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Production Engineering">Production Engineering</option>
                        <option value="E & TC Engineering">E & TC Engineering</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                        <option value="MCA">MCA</option>
                    </select>
                </div>
                <div class="kt-year">
                    <object type="image/svg+xml" data="../assets/img/svg/year.svg"></object>
                    <input type="text" placeholder="Enter Year" name="year" />
                </div>
            </div>

            <div class="kt-input-block">
                <div class="kt-subject" style="margin-right: 20px;">
                    <object type="image/svg+xml" data="../assets/img/svg/subject.svg"></object>
                    <input type="text" placeholder="Enter Subject" name="subject" />
                </div>
            </div>

            <button type="submit" name="add_subject" class="kt-button">
                Add</button>
        </form>
    </div>
</body>

</html>