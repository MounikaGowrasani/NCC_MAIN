<?php
// Start a session if not already started
session_start();

if (isset($_SESSION['campIdd'])) {
    $campId = $_SESSION['campIdd'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ncc";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['uname'])) {
        $username = $_SESSION['uname'];

        // Check if an application with the same campId and regno already exists
        $checkSql = "SELECT * FROM register WHERE campId = '$campId' AND regno = '$username'";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows == 0) {
            // No existing application, proceed to insert a new one
            $status = "no";

            // Insert data into the 'register' table
            $sql = "INSERT INTO register (campId, regno, status) VALUES ('$campId', '$username', '$status')";

            if ($conn->query($sql) === TRUE) {
                echo "Application submitted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "You have already applied for this camp.";
        }
    } else {
        echo "Session error: 'uname' not set in the session.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Session error: 'campIdd' not set in the session.";
}
?>
