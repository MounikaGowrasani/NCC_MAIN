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
        // echo "Registration Number: " . $registrationNumber;
    }
    // Query to fetch campid, campname, and certificate status based on Registration_number
    $sql = "SELECT r.campid, c.name, r.camp_certificate
            FROM camps c
            JOIN register r ON c.campid = r.campid
            WHERE r.regno = '$registrationNumber' AND r.status='yes'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table header and form
        echo "<form action='upload_certificate.php' method='post' enctype='multipart/form-data'>";
        echo "<table border='1'><tr><th>Camp ID</th><th>Camp Name</th><th>Upload/Download Certificate</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Display campid, campname, and handle upload or download based on certificate status
            $campid = $row['campid'];
            $camp_certificate = $row['camp_certificate'];

            echo "<tr><td>".$campid."</td><td>".$row['name']."</td><td>";

            if (is_null($camp_certificate)) {
                // If the certificate is NULL, allow uploading a new certificate
                echo "<input type='file' name='certificate'/>";
                echo "<input type='hidden' name='campid' value='$campid'/>";
                echo "<input type='hidden' name='registrationNumber' value='$registrationNumber'/>";
                echo "<input type='submit' name='upload_$campid' value='Upload Certificate'>";
            } else {
                // If a certificate exists, display a link to download it
                echo "<a href='download_certificate.php?campid=$campid' download>Download Certificate</a>";
            }

            echo "</td></tr>";
        }

        // Close the table
        echo "</table>";
        echo "</form>";
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
