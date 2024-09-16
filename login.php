<?php
include ('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM teachers WHERE teacher_name = ? AND password = ?");
    
    if ($stmt) {

        $stmt->bind_param("ss", $username, $password); 
        
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            session_start();
            $_SESSION['username'] = $username;

            header("Location: dashboard.php"); 
            exit();
        } else {
            
            echo "Invalid username or password.";
        }
        
        $stmt->close();
    } else {
     
        echo "Error: " . $connection->error;
    }

    $connection->close();
}
?>
