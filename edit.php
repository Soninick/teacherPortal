<?php
include ('config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        die("Student not found.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $marks = $_POST['marks'];
    $subject = $_POST['subject'];

    $sql = "UPDATE students SET student_name = ?, marks = ?, subject = ? WHERE student_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sisi", $student_name, $marks, $subject, $student_id);
    $stmt->execute();

    header("Location: dashboard.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="dashboard.css"> 
</head>
<body>
    <div class="edit-container">
        <h1>Edit Student</h1>
        <form action="edit.php" method="post">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" value="<?php echo htmlspecialchars($student['student_name']); ?>" required>
            <label for="marks">Marks:</label>
            <input type="number" id="marks" name="marks" value="<?php echo htmlspecialchars($student['marks']); ?>" required>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($student['subject']); ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
