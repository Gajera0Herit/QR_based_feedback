<?php
session_start();
include("connection.php");

$errors = [];

$user_check = $_SESSION['teacher_login'];

$ses_sql = "select t_id, t_name, t_email from teachers where t_email = '$user_check' ";

$ses_res = $conn->query($ses_sql);

$row = $ses_res->fetch_array(MYSQLI_ASSOC);

$login_session_id = (int)$row['t_id'];

$login_session_email = $row['t_email'];

$login_session_name = $row['t_name'];


if (!isset($_SESSION['teacher_login'])) {
    header("location:index.php");
    die();
}
