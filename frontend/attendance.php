<!-- ATTENDANCE PAGE -->
<?php
    session_start();
    $user = $_SESSION['user'];

    $conn = mysqli_connect('localhost', 'rowingguy', 'password', 'rowing'); // Create connection

    $getuser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE memberid = '$user';"));
    $memberstatus = $getuser["memberstatus"];

    $date = date("Y-m-d");
    $time = date("h:i");
    $currentTimeCheckBefore = date("H:i", strtotime("-30 minutes" . $time));
    $currentTimeCheckAfter = date("H:i", strtotime("+30 minutes" . $time));

    $sql = "SELECT * FROM event WHERE substring(eventdate,1,10) = '$date' AND substring(eventdate,12,5) >= '$currentTimeCheckBefore' AND substring(eventdate,12,5) <= '$currentTimeCheckAfter';";
    $getEvent = mysqli_fetch_assoc(mysqli_query( $conn, $sql));   
    $currentEventID = $getEvent['eventid'];
    $currentEventName = $getEvent['eventname'];

    $getTime = mysqli_fetch_assoc(mysqli_query($conn, "SELECT substring(eventdate,12,5) as 'time' FROM event WHERE eventid = '$currentEventID';"));
    $currentEventTime = $getTime['time'];

    $beforeTime = date("H:i", strtotime("-30 minutes" . $currentEventTime));
    $afterTime = date("H:i", strtotime("+30 minutes" . $currentEventTime));

    $isEventToday = False;
    if ($getEvent != NULL) {
        $isEventToday = True;
    }
    $isEventNow = False;
    if ($time >= $beforeTime && $time <= $afterTime) {
        $isEventNow = True;
    }


    if(isset($_POST['markAttendance'])) {
        
        $event = $currentEventName;
        $eventid = $currentEventID;
        $memberid = $user;
        $membername = mysqli_fetch_assoc(mysqli_query($conn, "SELECT membername FROM member where memberid = '$user';"))['membername'];
     
        $here = $_POST['here'];
       
        if ($here === "I'm here!") {
            mysqli_query($conn, "INSERT INTO attends VALUES ('$memberid', '$membername', '$eventid', '$event');"); 
        }
    }

    mysqli_close($conn); // Close connection
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>CNU Rowing Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- For input field alignment -->
    <style>
        form  { display: table;
                margin: 0 auto; }
        p     { display: table-row; }
        label { display: table-cell; }
        input { display: table-cell; }
    </style>

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

    /* For Button PopUp */
        .buttonPop {
            font-size: 1em;
            padding: 10px;
            color: #fff;
            border: 2px solid #1f78e4;
            border-radius: 25px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease-out;
            background: #1f78e4;
        }
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s;
            visibility: hidden;
            opacity: 0;
        }
        .overlay:target {
            visibility: visible;
            opacity: 1;
        }
        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all 0.5s ease-in-out;
        }
        .popup h2 {
            margin: 10px;
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
            font-size: 16px;
        }   
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .popup .close:hover {
            color: #06D85F;
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px){
            .box{
                width: 70%;
            }
            .popup{
                width: 70%;
            }
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
        <div id="markAttendance" style="display:<?php echo $isEventNow ? 'block':'none' ?>"> 
                <div class="center">
                    <div class="box">
                        <a class="buttonPop" href="#popup3">Mark Attendance</a>
                    </div>
                    <div id="popup3" class="overlay">

                        <div class="popup">
                            <h2>Mark Attendance for</h2>
                            <a class="close" href="#">&times;</a>
                            <div class="content">
                            <form method="post" action="<?= $_SERVER['rowing']; ?>">
                            <h2>Event: <?php echo $currentEventName ?></h2>
                                <br/>
                                <input type="radio" name="here" value="I'm here!" Required>I'm here!
                                <br/>
                                <br/>
                                <input type="submit" class='buttonPop' name="markAttendance" value="Save">
                            </form>
                            
                        </div>  
                    </div>
                </div>
            </div>
            </div>
            <br/>
            <table>
                <tr>
                <th>Events you have attended</th>
                <th>Date</th>
                </tr>
                <?php 
                        $conn = mysqli_connect('localhost', 'rowingguy', 'password', 'rowing'); // Create connection

                        $sql = 
                            "select a.eventid, a.memberid, e.eventid, e.eventname, e.eventdate, m.memberid
                            from attends a, event e, member m
                            where a.eventid = e.eventid AND
                            a.memberid = m.memberid AND
                            m.memberid = $user
                            order by e.eventdate;";
    
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
                        $conn = mysqli_connect('localhost', 'rowingguy', 'password', 'rowing'); // Create connection

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
                <br/>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="attendance.js"></script> 
</body>
