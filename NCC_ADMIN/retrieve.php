<!DOCTYPE html>
<html>
<head>
    <title>Retrieve PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #333;
            margin: 10px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block; /* Add this line to make them inline-block elements */
            margin-bottom: 10px; /* Add margin to create space between links and buttons */
        }
        
        /* Give space between links and buttons */
        button {
            margin-top: 10px; /* Adjust this margin as needed */
        }
        
        #update {
            margin-top: 20px; /* Increase the margin-top if you want more space */
        }
    </style>
</head>
<body>
    <?php
if (isset($_POST["update"])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ncc";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $scheduleType = $_POST['schedule_type'];


        // File upload was successful, now update the database
        $sql = "";
        $years=Date('Y');
        if ($scheduleType === 'update1') {
            echo "hi";
            
            // SQL query for updating Schedule 1
            $sql = "UPDATE pdf_files SET file_content = '$targetFile' WHERE unit='10A' and years='$years'";
        } elseif ($scheduleType === 'update2') {
            // SQL query for updating Schedule 2
            $sql = "UPDATE pdf_files SET file_content = '$targetFile' WHERE unit='25A' and years='$years'";
        }

        
    $conn->close();
}
?>

    <h2>Retrieve PDF</h2>
    <div class="container">
        <a href="retrieve1.php" target="_self">View ANO1(10A) Schedule</a>
        <br>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="schedule_file_1" accept=".pdf">
            <input type="hidden" name="schedule_type" value="update1">
            <button type="submit" name="update" id="update">Update Schedule</button>
        </form>
    </div>
    <br>
    <br>
    <div class="container">
        <a href="retrieve2.php">View ANO2(25A) Schedule</a>
        <br>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="schedule_file_2" accept=".pdf">
            <input type="hidden" name="schedule_type" value="update2">
            <button type="submit" name="update" id="update">Update Schedule</button>
        </form>
    </div>
</body>
</html>
