<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM students WHERE is_active = 1";
$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Student Details</h1>
        <button id="addStudentBtn">Add New Student</button> 
        
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Marks</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marks']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . htmlspecialchars($row['student_id']) . "'>Edit</a>  
                            <a href='remove.php?id=" . htmlspecialchars($row['student_id']) . "'>Remove</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add New Student Modal start from here -->
        <div id="addStudentModal" style="display:none;">
            <form id="addStudentForm">
                <h2>Add New Student</h2>
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" required>
                
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
                
                <label for="marks">Marks:</label>
                <input type="number" id="marks" name="marks" required>
                
                <input type="submit" value="Add Student">
            </form>
        </div>
    </div>
    <script src="dashboard.js"></script>
</body>
</html>
