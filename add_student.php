<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['student_name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    // record already exists
    $check_sql = "SELECT COUNT(*) FROM students WHERE student_name = ? AND subject = ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("ss", $student_name, $subject);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        // Record update
        $update_sql = "UPDATE students SET marks = ? WHERE student_name = ? AND subject = ?";
        $update_stmt = $connection->prepare($update_sql);
        $update_stmt->bind_param("iss", $marks, $student_name, $subject);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Record insert
        $insert_sql = "INSERT INTO students (student_name, subject, marks, is_active) VALUES (?, ?, ?, 1)";
        $insert_stmt = $connection->prepare($insert_sql);
        $insert_stmt->bind_param("ssi", $student_name, $subject, $marks);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    header("Location: dashboard.php");
    exit();
}
?>
