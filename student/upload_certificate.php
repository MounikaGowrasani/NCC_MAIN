<?php
// Start a session if not already started
session_start();

if (isset($_POST['campid']) && isset($_POST['registrationNumber']) && isset($_FILES['certificate'])) {
    $campid = $_POST['campid'];
    $registrationNumber = $_POST['registrationNumber'];

    // Check if the uploaded file is a PDF
    $fileExtension = pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION);

    if ($fileExtension === 'pdf') {
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

        // Read the contents of the uploaded file
        $certificateContent = file_get_contents($_FILES['certificate']['tmp_name']);
        $escapedFileContent = $conn->real_escape_string($certificateContent);

        // Update the certificate in the database for the specified camp and registration number
        $insertSql = "UPDATE register SET camp_certificate='$escapedFileContent' WHERE campid=$campid AND regno='$registrationNumber'";

        if ($conn->query($insertSql) === TRUE) {
            echo "Certificate uploaded successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Please upload a PDF file.";
    }
} else {
    echo "Invalid request parameters.";
}
?>
