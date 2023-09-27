<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=student_list.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
	require_once 'dbcon.php';
 
	$output = "";
 
	$output .="
		<table>
			<thead>
				<tr>
					<th>Student ID</th>
					<th>Student Name</th>
					<th>Phone number</th>
                    <th>File</th>
					<th>Date__of__birth</th>
                    <th>Photo</th>
                    <th>Aadhar number</th>
				</tr>
			<tbody>
	";
 
	$query = $conn->query("SELECT * FROM `enroll`") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
 
	$output .= "
				<tr>
					<td>".$fetch['Registration_number']."</td>
					<td>".$fetch['stu_name']."</td>
					<td>".$fetch['pno']."</td>
                    <td>".$fetch['file_name']."</td>
                    <td>".$fetch['Date__of__birth']."</td>
                    <td>".$fetch['photo_name']."</td>
                    <td>"."'".$fetch['Aadhar_number']."</td>
				
				</tr>
	";
	}
 
	$output .="
			</tbody>
 
		</table>
	";
 
	echo $output;
    ?>