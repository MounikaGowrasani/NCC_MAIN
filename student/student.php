<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Basic CSS for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #2D3092;
            color: #fff;
            padding: 0px;
            text-align: center;
            display: flex; 
            align-items: center; 
            position:relative;
            height:80px;
        }

        #menu-button {
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 24px; /* Adjust the font size as needed */
        }

        #profile-button {
            background-color: #fff;
            color: #333;
            border: none;
            padding: 10px 20px;
           right:10px;
           position:absolute;
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px; /* Adjust the font size as needed */
        }

        #profile-details {
            display: none;
            background-color: #fff;
            padding: 20px;
            text-align: left;
            color: #333;
            position: absolute;
            top: 60px;
            right: 0;
            z-index: 1;
        }

        #profile-details p {
            margin: 10px 0;
        }

        #update-password-button,
        #logout-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        /* Style the "Dashboard" text */
        #dashboard-text {
            margin-left: 35px; /* Adjust the margin as needed */
            font-size: 24px; /* Adjust the font size as needed */
        }

        #container {
            display: flex;
        }
        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

/* Style the modal content */
.modal-content {
    background-color: #fff;
    padding: 20px;
    width: 500px;
    margin: 15% auto;
    border: 1px solid #333;
    border-radius: 5px;
    position: relative;
}

/* Style the close button */
.close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 5px 10px;
    cursor: pointer;
}

.close:hover {
    color: #f00;
}

        #menu {
            background-color: #eee;
            width: 20%;
            padding: 20px;
        }

        #content {
            width: 80%;
            padding: 20px;
        }

        #footer {
            clear: both;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* Style links in the menu */
        #menu ul {
            list-style-type: none;
            padding: 0;
        }

        #menu li {
            margin-bottom: 10px;
        }

        #menu a {
            display: block;
            padding: 20px;

            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        h2
        {
            
            margin:0 auto;
            font-size: 30px;
            text-align: center;
            
        }
        #menu a:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Hide the dashboard by default */
        #dashboard {
            display: none;
        }
    </style>
    <script src="preventBack.js"></script>
</head>
<body>
<?php
// Start the session to access session variables
require('C:\xampp\htdocs\NCC_MAIN\NCC_LOGIN\dbcon.php');
session_start();
// Check if the 'uname' session variable exists
if (isset($_SESSION['uname'])) {
    $username = $_SESSION['uname'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT stu_name,pno FROM enroll WHERE regimental_number = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Output data of the student
        while ($row = $result->fetch_assoc()) {
            $studentName = $row['stu_name'];
            $mno=$row['pno'];
        }
    } else {
        echo "Student not found.";
    }

    // Close the result set
    $result->close();
    
    // Close the database connection
    $conn->close();
}
 else
    echo "log out";


    if (isset($_POST['update_password'])) {
        // Handle password update here
        $newPassword = $_POST['new_password'];
        $confirmNewPassword = $_POST['confirm_new_password'];
        if ($newPassword === $confirmNewPassword) {
           
    
            // Check for a successful connection
            if ($conn->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
    
            // Update the password in the database
            $updateQuery = "UPDATE logins SET passwords = '$newPassword' WHERE username = '$username'";
            if ($conn->query($updateQuery) === TRUE) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $connection->error;
            }
    
            // Close the database connection
            $conn->close();
        } else {
            echo "New password and confirmation do not match.";
        }
    }
?>
    <div id="header">

        <h1 id="dashboard-text">Dashboard</h1>
        <h2>CADET</h2>
        <h4 style="right:100px; position:absolute;">Home</h4>
        <div id="profile-button" onclick="toggleProfileDetails()"><img src="profileicon.jpeg" style="width: 30px; height: 30px;"></img></div>
        <div id="profile-details">
            <p>Name: <?php echo $studentName; ?></p>
            <p>Regimental number <?php echo $username; ?></p>
            <p>Mobile no: <?php echo $mno; ?></p>
            <button id="update-password-button" onclick="showPasswordForm()">Update Password</button>
            <button id="logout-button" onclick="logout()">Logout</button>
        </div>
    </div>
    <div id="password-form" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closePasswordForm()">&times;</span>
        <form method="post" action="">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required><br>
            <br>
            <label for="confirm_new_password">Confirm New Password:</label>
            <input type="password" name="confirm_new_password" required><br>
            <br>
            <input type="submit" name="update_password" value="Save Password">
        </form>
    </div>
</div>
    <div id="container">
        <div id="menu">
            <!-- This is where the list will be dynamically generated -->
        </div>

        <div id="dashboard">
            <div id="content">
                <img src="10.jpeg" alt="image" height="500px" width="1000px">
            </div>
        </div>
    </div>

    <div id="footer">
        &copy; 2023 Vignan University
    </div>

    <script>
            var menu = document.getElementById('menu');
            var dashboard = document.getElementById('dashboard');
                dashboard.style.display = 'block';
                menu.innerHTML = '<ul style="list-style-type:none;">' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-calendar-alt" style="margin-right: 10px;"></i><a href="#camp" onclick="showContent(\'SCHEDULE\')">VIEW SCHEDULE</a></li>' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-calendar" style="margin-right: 10px;"></i><a href="#events" onclick="showContent(\'EVENTS\')">VIEW EVENTS</a></li>' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-campground" style="margin-right: 10px;"></i><a href="#camps" onclick="showContent(\'CAMPS\')">VIEW CAMPS</a></li>' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-check-circle" style="margin-right: 10px;"></i><a href="#camps" onclick="showContent(\'R1CAMPS\')">REGISTERED CAMPS</a></li>' +

                '<li style="display: flex; align-items: center;"><i class="fas fa-comments" style="margin-right: 10px;"></i><a href="#feedback" onclick="showContent(\'FEEDBACK\')"> FEEDBACK</a></li>' +

                '<li style="display: flex; align-items: center;"><i class="fas fa-question-circle" style="margin-right: 10px;"></i><a href="#queries" onclick="showContent(\'QUERIES\')"> QUERIES</a></li>' +

    '</ul>';
    
        // JavaScript function to show content for the selected link
        function showContent(content) {
    var contentDiv = document.getElementById('content');
    if (content === 'EVENTS') {
        contentDiv.innerHTML = '<iframe src="view_events3.php" width="1000px" height="500px"></iframe>';
    } 
    else if(content === 'CAMPS')
    {
        contentDiv.innerHTML= '<iframe src="view_camps2.php" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'SCHEDULE')
    {
        contentDiv.innerHTML= '<iframe src="viewschedule.php" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'FEEDBACK')
    {
        contentDiv.innerHTML= '<iframe src="feedback.html" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'R1CAMPS')
    {
        contentDiv.innerHTML= '<iframe src="regcamps.php" width="1000px" height="500px"></iframe>';
    }
    else {
        contentDiv.innerHTML = '<h2>' + content + '</h2>' +
            '<p>This is the content for ' + content + '</p>';
    }
}
function toggleProfileDetails() {
            var profileDetails = document.getElementById('profile-details');
            if (profileDetails.style.display === 'block') {
                profileDetails.style.display = 'none';
            } else {
                profileDetails.style.display = 'block';
            }
        }

    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $('.editable').on('blur', function () {
            var newValue = $(this).text();
            var columnName = $(this).data('column');
    
            // Send an AJAX request to update the value in the database
            $.ajax({
                url: 'update_database.php',
                method: 'POST',
                data: {
                    column: columnName,
                    newValue: newValue,
                    // Add any other data you need to identify the record
                },
                success: function (response) {
                    // Handle the response from the server if needed
                }
            });
        });
    });

    function logout() {
    // Send an AJAX request to the server to log out the user
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/NCC_MAIN/NCC_LOGIN/logout.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Display the "Logout successful" alert
            alert("Logout successful");
            // Redirect to the login page if needed
            window.location.href ="/NCC_MAIN/NCC_LOGIN/loginmain.php"; // Replace with your actual login page URL
           
        }
    };
    xhr.send();

  
}
document.getElementById("update-password-button").addEventListener("click", function() {
    showPasswordForm();
});

// Function to display the password form dialog
function showPasswordForm() {
    var modal = document.getElementById("password-form");
    modal.style.display = "block";
}

// Function to close the password form dialog
function closePasswordForm() {
    var modal = document.getElementById("password-form");
    modal.style.display = "none";
}


    </script>
    <script src="preventBack.js"></script>
</body>

</html>