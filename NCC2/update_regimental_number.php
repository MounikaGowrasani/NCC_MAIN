<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncc";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $studentId = $_POST['student_id'];
    $newRegimentalNumber=$_POST['new_regimental_number'];

    $checkSql = "SELECT COUNT(*) FROM enroll WHERE regimental_number = ?";
    $stmtCheck = $conn->prepare($checkSql);
    $stmtCheck->bind_param("s", $newRegimentalNumber);
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($count > 0) {
        // The regimental number already exists, display an alert
        echo '<script>alert("Regimental number already exists."); window.history.back();</script>';
    }else{
    // Update the database with the new regimental_number
    $updateSql = "UPDATE enroll SET regimental_number = ?, regimental_number_updated = 1 WHERE Registration_number = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ss", $newRegimentalNumber, $studentId);

    if ($stmt->execute()) {
        echo '<script>alert("Regimental number updated successfully");window.location.href ="regment.php`";</script>';
        
        
    } else {
        echo "Error updating Regimental Number: " . $stmt->error;

    }

    // Close the statement
    $stmt->close();
}
}

// Close the database connection
$conn->close();
?>