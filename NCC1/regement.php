<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncc";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM enroll where ncc_unit_enrolled='65-G,10(A)GBN NCC,Guntur' OR '10A'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th>
    <th>stu_name</th>
    <th>pno</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Registration_number</th>
    <th>photo</th>
    <th>Name_of_school</th> 
    <th>Stream</th>
    <th>PAN_card_no</th>
    <th>Aadhar_number</th>
    <th>Date__of__birth </th>
    <th>father_name </th>
    <th>mother_name </th>
    <th>nationality </th>
    <th>bank_name </th>
    <th>account_no </th>
    <th>ifsc_code </th>
    <th>edu_qualification </th>
    <th>marks </th>
    <th>com_address</th> 
    <th>com_pincode</th>
    <th>identification_mark1 </th>
    <th>identification_mark2 </th>
    <th>blood_group</th> 
    <th>place </th>
    <th>Datee</th>
    </tr>";
    $id=1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $id . "</td><td>" . $row["stu_name"] . "</td><td>" . $row["pno"] ."</td><td>" . $row["Email"] . "</td><td>" . $row["Gender"] ."</td><td>" . $row["Registration_number"] . "</td><td>";


        if (isset($row["photo_data"])) {
            // Assuming the "photo_data" column contains the image data
            // Display the image using an <img> tag
            echo "<img src='data:image/png;base64," . base64_encode($row["photo_data"]) . "' alt='Student Photo' width='100'>";
        } else {
            echo "No photo available";
        }
    
      
    
        echo "</td><td>" . $row["Name_of_school"] . "</td><td>" . $row["Stream"] ."</td><td>" . $row["PAN_crad"] . "</td><td>" . $row["Aadhar_number"] ."</td><td>" . $row["Date__of__birth"] . "</td><td>" . $row["father_name"] ."</td><td>" . $row["mother_name"] . "</td><td>" . $row["nationality"] ."</td><td>" . $row["bank_name"] . "</td><td>" . $row["account_no"] ."</td><td>" . $row["ifsc_code"] . "</td><td>" . $row["edu_qualification"] ."</td><td>" . $row["marks"] . "</td><td>" . $row["com_address"] ."</td><td>" . $row["com_pincode"] . "</td><td>" . $row["identification_mark1"] ."</td><td>".$row["identification_mark2"] . "</td><td>" . $row["blood_group"]."</td><td>".$row["place"] . "</td><td>" . $row["Datee"] ."</td></tr>";
    $id=$id+1;


    }
    echo "</table>";
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>
