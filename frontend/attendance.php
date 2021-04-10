<!-- ATTENDANCE PAGE -->
<?php
    session_start();
    $user = $_SESSION['user'];
    // echo $user;

    $conn = mysqli_connect("localhost", "root", "root", "rowing"); // Create connection

    $getuser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE memberid = '$user';"));
    $memberstatus = $getuser["memberstatus"];
    // echo $memberstatus;

    mysqli_close($conn); // Close connection
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
                <th>Events you have attended</th>
                <th>Date</th>
                </tr>
                <?php 
                        $conn = mysqli_connect("localhost", "root", "root", "rowing"); // Create connection

                        $sql = 
                            "select a.eventid, a.memberid, e.eventid, e.eventname, e.eventdate, m.memberid
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
            </table>

            <div id="attendance" style="display:<?php echo $memberstatus == "e-board" ? 'block':'none' ?>"> 
                <div class="center">
                    <h1> Team Attendance </h1>
                </div>
            
                <table>
                    <tr>
                        <th>Events</th>
                        <th>Date</th>
                        <th>Members in Attendance</th>
                    </tr>
                    <?php 
                        $conn = mysqli_connect("localhost", "root", "root", "rowing"); // Create connection

                        $sql = 
                            "select a.eventname, eventdate, membername 
                            from attends a, event e
                            where a.eventid = e.eventid
                            order by eventdate;";
        
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["eventname"]. 
                                 "</td><td>" . $row["eventdate"]. 
                                 "</td><td>" . $row["membername"]. 
                                 "</td></tr>";
                        }
                        echo "</table>";
                        } else { echo "0 results"; }
                        $conn->close();
                        ?>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="attendance.js"></script> 
</body>
