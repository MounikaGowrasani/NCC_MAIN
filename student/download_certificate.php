<?php
// Check if the campid is provided in the query string
if (isset($_GET['campid'])) {
    // Retrieve the campid from the query string
    $campid = $_GET['campid'];

    // Define the database connection parameters
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

    // Use prepared statements to fetch the certificate content
    $sql = "SELECT camp_certificate FROM register WHERE campid = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $campid); // "i" stands for integer, assuming campid is an integer
    
    if ($stmt->execute()) {
        $stmt->bind_result($certificateContent);
        $stmt->fetch();
        
        // Set the appropriate HTTP response headers for downloading a PDF
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=certificate_campid_$campid.pdf");

        // Output the certificate content
        echo $certificateContent;
    } else {
        // If no certificate is found for the specified camp
        echo "Certificate not found for camp ID: $campid.";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If campid is not provided in the query string
    echo "Camp ID not provided in the query string.";
}
?>
