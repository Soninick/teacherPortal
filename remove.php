<?php
include ('config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $sql = "UPDATE students SET is_active = 0 WHERE student_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();

    header("Location: dashboard.php"); 
    exit();
}
?>
