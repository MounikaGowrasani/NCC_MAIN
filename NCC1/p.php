<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        /* Basic CSS for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 0px;
            text-align: center;
            display: flex; 
            align-items: center; 
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
            margin-left: 550px;
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
            margin-left: 300px;
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
</head>
<body>
    <div id="header">

        <h1 id="dashboard-text">Dashboard</h1>
        <h2>ASSOCIATE NCC OFFICER-1</h2>
        <div id="profile-button" onclick="toggleProfileDetails()">👤</div>
        <div id="profile-details">
            <p>Name: John Doe</p>
            <p>Employee ID: 12345</p>
            <p>Phone no: 9876543210</p>
            <button id="update-password-button">Update Password</button>
            <button id="logout-button">Logout</button>
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
                menu.innerHTML = '<ul style="list-style-type:disc;">' +
                    '<li><a href="#camp" onclick="showContent(\'SCHEDULE\')">UPLOAD SCHEDULE</a></li>' +
                    '<li><a href="#regement.html" onclick="showContent(\'REGMENT\')">ENROLLED STUDENTS</a></li>' +
                    '<li><a href="#leave" onclick="showContent(\'EVENTS\')">ADD EVENTS</a></li>' +
                    '<li><a href="#training" onclick="showContent(\'CAMPS\')">ADD CAMPS</a></li>' +
                    '<li><a href="#training" onclick="showContent(\'VCAMPS\')">VIEW CAMPS</a></li>' +
                    '<li><a href="http://192.168.10.10/stuCurStatusSectionReg21.jsp" onclick="showContent(\'CADET DETAILS\')">CADET INFORMATION</a></li>' +
                    '<li><a href="#feedback.html" onclick="showContent(\'FEEDBACK\')">VIEW FEEDBACK</a></li>' +
                    '<li><a href="#profile" onclick="showContent(\'QUERIES\')">VIEW QUERIES</a></li>' +
                    '</ul>';
    
        // JavaScript function to show content for the selected link
        function showContent(content) {
    var contentDiv = document.getElementById('content');
    if (content === 'EVENTS') {
        // Load events.html in an iframe
        contentDiv.innerHTML = '<iframe src="events.html" width="1000px" height="500px"></iframe>';
    } 
    else if(content === 'CAMPS')
    {
        contentDiv.innerHTML= '<iframe src="camps.html" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'SCHEDULE')
    {
        contentDiv.innerHTML= '<iframe src="upload.html" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'REGMENT')
    {
        contentDiv.innerHTML= '<iframe src="regement.php" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'VCAMPS')
    {
        contentDiv.innerHTML= '<iframe src="view_camps.php" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'FEEDBACK')
    {
        contentDiv.innerHTML= '<iframe src="feedback.php" width="1000px" height="500px"></iframe>';
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
    
    
</body>
</html>
