<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve registerid from the URL parameter
    $registerid = $_GET['registerid'];
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
</head>
<body>
    <h1>Upload Certificate</h1>
    <form action="final_upload.php" method="post" enctype="multipart/form-data">
        <label for="certificateFile">Choose Certificate File:</label>
        <input type="file" name="certificateFile" id="certificateFile" accept="image/*" required><br><br>
        <input type="hidden" name="registerid" value="<?php echo isset($registerid) ? $registerid : ''; ?>">
        <input type="submit" value="Upload Certificate">
    </form>
</body>
</html>