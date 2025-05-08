<?php
include('session.php');

// Get all students
$students_sql = "SELECT s_id, s_name, s_email, s_phone, s_branch, s_year FROM students";
$students_result = $conn->query($students_sql);

// Get students who have provided feedback
$feedback_sql = "SELECT DISTINCT s_id FROM student_feedback";
$feedback_result = $conn->query($feedback_sql);

// Create array of students who have provided feedback
$feedback_students = array();
if ($feedback_result && $feedback_result->num_rows > 0) {
    while ($row = $feedback_result->fetch_assoc()) {
        $feedback_students[] = $row['s_id'];
    }
}

// Process email sending if requested
if (isset($_POST['send_reminder'])) {
    $email_count = 0;
    $email_errors = 0;
    
    // Process each student who hasn't provided feedback
    if (isset($_POST['students']) && is_array($_POST['students'])) {
        foreach ($_POST['students'] as $student_id) {
            // Get student details
            $stmt = $conn->prepare("SELECT s_name, s_email FROM students WHERE s_id = ?");
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $to = $row['s_email'];
                $subject = "Feedback Reminder";
                $message = "Dear " . $row['s_name'] . ",\n\n";
                $message .= "We noticed you haven't submitted your feedback yet. Your input is valuable to us.\n";
                $message .= "Please take a moment to provide your feedback.\n\n";
                $message .= "Thank you,\nThe Administration Team";
                $headers = "From: admin@example.com";
                
                // Send email
                if (mail($to, $subject, $message, $headers)) {
                    $email_count++;
                } else {
                    $email_errors++;
                }
            }
            $stmt->close();
        }
        
        // Set message based on results
        if ($email_count > 0) {
            $_SESSION['email_message'] = "Successfully sent reminder emails to $email_count students.";
        } else {
            $_SESSION['email_error'] = "Failed to send reminder emails. Please try again.";
        }
        
        if ($email_errors > 0) {
            $_SESSION['email_error'] = "Failed to send $email_errors emails. Please check your email configuration.";
        }
    } else {
        $_SESSION['email_error'] = "No students selected for email reminders.";
    }
    
    // Redirect to refresh the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Simple query to count feedback by branch
$feedback_sql = "SELECT students.s_branch, COUNT(DISTINCT student_feedback.s_id) as feedback_count 
                FROM students 
                LEFT JOIN student_feedback ON students.s_id = student_feedback.s_id 
                GROUP BY students.s_branch";
$feedback_result = $conn->query($feedback_sql);

// Process feedback data for the chart
$branch_labels = [];
$feedback_counts = [];

if ($feedback_result && $feedback_result->num_rows > 0) {
    while ($row = $feedback_result->fetch_assoc()) {
        $branch_labels[] = $row['s_branch'];
        $feedback_counts[] = $row['feedback_count'];
    }
}

// Convert to JSON for JavaScript
$branch_labels_json = json_encode($branch_labels);
$feedback_counts_json = json_encode($feedback_counts);

// Get total feedback count
$total_feedback_sql = "SELECT COUNT(DISTINCT s_id) as total FROM student_feedback";
$total_feedback_result = $conn->query($total_feedback_sql);
$total_feedback = 0;
if ($total_feedback_result && $row = $total_feedback_result->fetch_assoc()) {
    $total_feedback = $row['total'];
}

// Student deletion functionality
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="dashboard_style.css">
    <!-- Chart.js for visualization (minified version) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <title>Students List</title>
    <style>
        .feedback-summary {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 15px;
            display: flex;
            align-items: center;
        }
        
        .feedback-count {
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
            margin-right: 15px;
        }
        
        .feedback-label {
            color: #555;
        }
        
        .small-chart {
            width: 300px;
            height: 200px;
            margin-left: auto;
        }
        
        .feedback-status {
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        
        .feedback-received {
            background-color: #e6fff2;
            color: #00994d;
        }
        
        .feedback-pending {
            background-color: #fff0e6;
            color: #ff6600;
        }
        
        .action-buttons {
            margin-bottom: 20px;
        }
        
        .kt-button {
            padding: 8px 16px;
            margin-right: 10px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }
        
        .kt-button-primary {
            background-color: #3498db;
            color: white;
            border: none;
        }
        
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .checkbox-column {
            width: 40px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include_once('aside/header.php'); ?>
    
    <div class="kt-dashboard-div">
        <div class="kt-dashboard-title">Students List</div>
        
        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['email_message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['email_message']; 
                    unset($_SESSION['email_message']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['email_error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['email_error']; 
                    unset($_SESSION['email_error']);
                ?>
            </div>
        <?php endif; ?>
        
        <!-- Compact Feedback Summary -->
        <div class="feedback-summary">
            <div>
                <div class="feedback-count"><?php echo $total_feedback; ?></div>
                <div class="feedback-label">Students have provided feedback</div>
            </div>
            <div class="small-chart">
                <canvas id="feedbackChart"></canvas>
            </div>
        </div>
        
        <!-- Email reminder form -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="action-buttons">
                <button type="submit" name="send_reminder" class="kt-button kt-button-primary">
                    <i class="fas fa-envelope"></i> Send Reminder to Selected Students
                </button>
                <button type="button" id="selectAll" class="kt-button">Select All Pending</button>
                <button type="button" id="deselectAll" class="kt-button">Deselect All</button>
            </div>
            
            <!-- Students Table -->
            <table class="kt-dashboard-table">
                <thead>
                    <tr>
                        <th class="checkbox-column"><input type="checkbox" id="masterCheckbox"></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Branch</th>
                        <th>Year</th>
                        <th>Feedback Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($students_result && $students_result->num_rows > 0) {
                        // Reset pointer to beginning
                        $students_result->data_seek(0);
                        
                        while ($students_row = $students_result->fetch_assoc()) {
                            $has_feedback = in_array($students_row["s_id"], $feedback_students);
                            
                            echo "<tr>";
                            echo "<td class='checkbox-column'>";
                            if (!$has_feedback) {
                                echo "<input type='checkbox' name='students[]' value='" . $students_row["s_id"] . "' class='student-checkbox'>";
                            } else {
                                echo "&nbsp;";
                            }
                            echo "</td>";
                            
                            echo "<td>" . $students_row["s_name"] . "</td>";
                            echo "<td>" . $students_row["s_email"] . "</td>";
                            echo "<td>" . $students_row["s_phone"] . "</td>";
                            echo "<td>" . $students_row["s_branch"] . "</td>";
                            echo "<td>" . $students_row["s_year"] . "</td>";
                            
                            if ($has_feedback) {
                                echo "<td><span class='feedback-status feedback-received'>Received</span></td>";
                            } else {
                                echo "<td><span class='feedback-status feedback-pending'>Pending</span></td>";
                            }
                            
                            echo "<td><a href='students_tab.php?delete_id=" . $students_row['s_id'] . "' class='kt-button'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='8'>No students found</td>";
                        echo "</tr>";
                    }
                    
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart initialization
            const ctx = document.getElementById('feedbackChart').getContext('2d');
            
            const branchLabels = <?php echo $branch_labels_json ?: '[]'; ?>;
            const feedbackCounts = <?php echo $feedback_counts_json ?: '[]'; ?>;
            
            if (branchLabels.length === 0) {
                ctx.font = '12px Arial';
                ctx.fillText('No feedback data', 10, 50);
            } else {
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: branchLabels,
                        datasets: [{
                            data: feedbackCounts,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    boxWidth: 12,
                                    font: {
                                        size: 10
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Feedback by Branch',
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                });
            }
            
            // Master checkbox functionality
            const masterCheckbox = document.getElementById('masterCheckbox');
            const studentCheckboxes = document.querySelectorAll('.student-checkbox');
            
            if (masterCheckbox) {
                masterCheckbox.addEventListener('change', function() {
                    studentCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = masterCheckbox.checked;
                    });
                });
            }
            
            // Select all pending feedback students
            const selectAllBtn = document.getElementById('selectAll');
            if (selectAllBtn) {
                selectAllBtn.addEventListener('click', function() {
                    studentCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = true;
                    });
                    if (masterCheckbox) masterCheckbox.checked = true;
                });
            }
            
            // Deselect all students
            const deselectAllBtn = document.getElementById('deselectAll');
            if (deselectAllBtn) {
                deselectAllBtn.addEventListener('click', function() {
                    studentCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    if (masterCheckbox) masterCheckbox.checked = false;
                });
            }
        });
    </script>
</body>

</html>