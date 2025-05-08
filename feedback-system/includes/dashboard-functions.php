<?php
include('includes/session.php');

//Show table

$arr1 = [];
$arr2 = [];


// $sql1 = "SELECT DISTINCT TE.t_name as t_name, TS.sub_id as sub_id FROM `teacher_subjects` TS, teachers TE, `student_feedback` SFB 
//         WHERE SFB.s_id=$login_session_id
//         AND SFB.t_id=TE.t_id 
//         AND NOT SFB.sub_id=TS.sub_id 
//         AND SFB.s_id = $login_session_id";

// $sql2 = "SELECT DISTINCT TE.t_name as t_name, TS.sub_id as sub_id FROM `teacher_subjects` TS, teachers TE, `student_feedback` SFB 
//         WHERE SFB.s_id=$login_session_id
//         AND SFB.t_id=TE.t_id 
//         AND SFB.sub_id=TS.sub_id 
//         AND SFB.s_id = $login_session_id";

// $result1 = $conn->query($sql1);
// $result2 = $conn->query($sql2);


// // print_r($result1);
// // echo "<br>";
// // print_r($result2);

// if ($result1->num_rows > 0) {
//     while ($row1 = $result1->fetch_assoc()) {
//         array_push($arr1, $row1['sub_id']);
//     }
// }

// if ($result2->num_rows > 0) {
//     while ($row2 = $result2->fetch_assoc()) {
//         array_push($arr2, $row2['sub_id']);
//     }
// }

// $diff = array_diff($arr1, $arr2);

// print_r($diff);

//New Logic

$sql1 = "SELECT DISTINCT sub_id FROM teacher_subjects 
        WHERE branch='$login_session_branch' 
        AND sub_year='$login_session_year'";

$sql2 = "SELECT DISTINCT TS.sub_id as sub_id FROM `teacher_subjects` TS, teachers TE, `student_feedback` SFB 
        WHERE SFB.s_id=$login_session_id
        AND SFB.t_id=TE.t_id 
        AND SFB.sub_id=TS.sub_id";

$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) {
        array_push($arr1, $row1['sub_id']);
    }
}

$result2 = $conn->query($sql2);


if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        array_push($arr2, $row2['sub_id']);
    }
}

$diff = array_diff($arr1, $arr2);
