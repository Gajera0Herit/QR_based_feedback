<?php
include('session.php');

$count_data = [];

$teachers_sql = "SELECT t_id, t_name, t_email, t_phone FROM teachers";
$teachers_result = $conn->query($teachers_sql);

if (isset($_GET['delete_id'])) {
    $_SESSION["delete_id"] = $_GET['delete_id'];

    $sql = "DELETE FROM teachers WHERE t_id='" . $_SESSION["delete_id"] . "'";

    if ($conn->query($sql)) {
        $page = $_SERVER['PHP_SELF'];
        $sec = "1";

        echo "<script>alert('Teacher deleted successfully!');</script>";
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
    <title>Teacher List</title>
</head>

<body>
    <?php include_once('aside/header.php'); ?>
    <div class="kt-dashboard-div">
        <div class="kt-dashboard-title">Teacher List</div>
        <table class="kt-dashboard-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($teachers_result->num_rows > 0) {
                    while ($teachers_row = $teachers_result->fetch_assoc()) {
                        echo "<td>" . $teachers_row["t_name"] . "</td>";
                        echo "<td>" . $teachers_row["t_email"] . "</td>";
                        echo "<td>" . $teachers_row["t_phone"] . "</td>";
                        echo "<td><a href='teachers_tab.php?delete_id=" . $teachers_row['t_id'] . "' class='kt-button'>Delete</a></td>";
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

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>