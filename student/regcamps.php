<?php
// Start a session if not already started
session_start();

if (isset($_SESSION['uname'])) {
    $username = $_SESSION['uname'];

    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $database = "ncc";

    // Create a database connection
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT Registration_number FROM enroll WHERE regimental_number = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If a record is found, fetch and store the Registration_number
        $row = $result->fetch_assoc();
        $registrationNumber = $row['Registration_number'];

        // Now, $registrationNumber contains the Registration_number based on the session username
        //echo "Registration Number: " . $registrationNumber;
    }
    // Query to fetch campid, campname based on Registration_number
    $sql = "SELECT r.campid, c.name
            FROM camps c
            JOIN register r ON c.campid = r.campid
            WHERE r.regno = '$registrationNumber' and r.status='yes'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table header
        echo "<table border='1'><tr><th>Camp ID</th><th>Camp Name</th><th>Upload Certificate</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Display campid and campname in each row and add an upload certificate button
            echo "<tr><td>".$row['campid']."</td><td>".$row['name']."</td><td><button>Upload Certificate</button></td></tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        // If no record is found for the session username
        echo "No records found for the given username.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Session error: 'uname' not set in the session.";
}
?>
