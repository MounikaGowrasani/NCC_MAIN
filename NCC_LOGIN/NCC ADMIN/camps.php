<?php
// Replace these with your actual database credentials
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

// Get data from the form
$campName = $_POST['campName'];
$location = $_POST['location'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$dailyAllowance = $_POST['dailyAllowance'];
$travelAllowance = $_POST['travelAllowance'];
$polAllowance = $_POST['polAllowance'];
$numberOfStudents = $_POST['numberOfStudents'];
$startDateTimestamp = strtotime($startDate);
$endDateTimestamp = strtotime($endDate);
$numberOfDays = ($endDateTimestamp - $startDateTimestamp) / (60 * 60 * 24) ; // Number of days between start and end date
$totalExpenditure = ($dailyAllowance + $travelAllowance + $polAllowance) *($numberOfDays+1);
// Insert data into the database
$sql = "INSERT INTO camps 
VALUES ('$campName', '$location', '$startDate', '$endDate', $dailyAllowance, $travelAllowance, $polAllowance, $numberOfStudents,$totalExpenditure)";
echo "hiii";
if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>