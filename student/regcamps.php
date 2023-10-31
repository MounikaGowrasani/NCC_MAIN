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
    $sql = "SELECT r.campid, c.name,r.registerid
            FROM camps c
            JOIN register r ON c.campid = r.campid
            WHERE r.regno = '$registrationNumber' AND r.status='yes'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table header and form
        echo "<form action='upload_certificate.php' method='post' enctype='multipart/form-data'>";
        echo "<table border='1'><tr><th>Serial No.</th><th>Camp ID</th><th>Camp Name</th><th>Upload/Download Certificate</th></tr>";
        $serialNumber = 1;

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Display campid, campname, and handle upload or download based on certificate status
            $campid = $row['campid'];
            $registerid=$row['registerid'];
            $certificateExists = false;
            $checkCertificateQuery = "SELECT certificate FROM camp_certificate WHERE registerid='$registerid'";
            $certificateResult = $conn->query($checkCertificateQuery);
            if ($certificateResult->num_rows > 0) {
                $certificateExists = true;
            }
            echo "<tr><td>".$serialNumber."</td><td>".$campid."</td><td>".$row['name']."</td><td>";

            if (!$certificateExists) {
                echo "<input type='hidden' name='registerid' value='$registerid'>";
                echo "<a href='upload_certificate.php?registerid=$registerid'>Upload Certificate</a>";

            } else {
                // If a certificate exists, display a link to download it
                echo "<a href='download_certificate.php?registerid=$registerid' download>Download Certificate</a>";

            }

            echo "</td></tr>";
            $serialNumber++;
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