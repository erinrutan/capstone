<!-- ATTENDANCE PAGE -->
<?php
    include_once '/db.php';
    session_start();
    echo $_SESSION['user'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNU Rowing Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- For table -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #002C76;
            font-family:"Quicksand",sans-serif;
            font-size: 20px;
            text-align: left;
            justify-content: center;
            align-items:center;
        }
        th {
            background-color: #1f78e4;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>
<body>  
    <div class="nav-bar"></div>

    <div class="center"><h1>CNU Rowing Club - Attendance</h1></div>

    <div class="product">
        <div class="grid-container">
            <back-button onclick="location.href='home.php';">
                <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
            </back-button>
        </div>
    </div>

    <div id="attendance">
        <div class="home-page">
        <table>
            <tr>
            <th>Events Attended</th>
            <th>Date</th>
            </tr>
            <?php 
                    $servername = "localhost";
                    $database = "rowing";
                    $username = "root";
                    $password = "root";
                    
                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $user = $_SESSION['user'];
                    $sql = "select a.eventid, a.memberid, e.eventid, e.eventname, e.eventdate, m.memberid
                    from attends a, event e, member m
                    where a.eventid = e.eventid AND
                          a.memberid = m.memberid AND
                          m.memberid = $user;";
 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["eventname"]. "</td><td>" . $row["eventdate"]. "</td></tr>";
                    }
                    echo "</table>";
                    } else { echo "0 results"; }
                    $conn->close();
                    ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="attendance.js"></script> 
</body>
