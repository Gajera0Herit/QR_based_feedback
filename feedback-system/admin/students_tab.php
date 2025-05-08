<?php
include('session.php');

$count_data = [];

$students_sql = "SELECT s_id, s_name, s_email, s_phone, s_branch, s_year FROM students";
$students_result = $conn->query($students_sql);

if (isset($_GET['delete_id'])) {
    $_SESSION["delete_id"] = $_GET['delete_id'];

    $sql = "DELETE FROM students WHERE s_id='" . $_SESSION["delete_id"] . "'";

    if ($conn->query($sql)) {
        $page = $_SERVER['PHP_SELF'];
        $sec = "1";

        echo "<script>alert('Student deleted successfully!');</script>";
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
    <link rel="stylesheet" href="dashboard_style.css">
    <script src="../assets/js/app.js"></script>
    <title>Students List</title>
</head>

<body>
    <?php include_once('aside/header.php'); ?>
    <div class="kt-dashboard-div">
        <div class="kt-dashboard-title">Students List</div>
        <table class="kt-dashboard-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Branch</th>
                    <th>Year</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($students_result->num_rows > 0) {
                    while ($students_row = $students_result->fetch_assoc()) {
                        echo "<td>" . $students_row["s_name"] . "</td>";
                        echo "<td>" . $students_row["s_email"] . "</td>";
                        echo "<td>" . $students_row["s_phone"] . "</td>";
                        echo "<td>" . $students_row["s_branch"] . "</td>";
                        echo "<td>" . $students_row["s_year"] . "</td>";
                        echo "<td><a href='students_tab.php?delete_id=" . $students_row['s_id'] . "' class='kt-button'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    echo "<td>NA</td>";
                    echo "<td></td>";
                    echo "</tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>