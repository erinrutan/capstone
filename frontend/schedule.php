<!-- SCHEDULE PAGE -->
<?php
    session_start();
    $user = $_SESSION['user'];
    // echo $user;

    $conn = mysqli_connect("localhost", "root", "root", "rowing"); // Connect to DB
 
    $getuser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE memberid = '$user';"));
    $memberstatus = $getuser["memberstatus"];
    // echo $memberstatus;

    if(isset($_POST['submit']))
    {		
        $eventname = $_POST['eventname'];
        $eventdate = $_POST['eventdate'];
        $eventlocation = $_POST['eventlocation'];
        $eventdescription = $_POST['eventdescription'];

        $insert = mysqli_query($conn,"INSERT INTO `event`
        VALUES (NULL,'$eventname','$eventlocation','$eventdate','$eventdescription','$user');");

        if(!$insert){
            echo mysqli_error();
        } else {
            echo "New event created!";
        }
    }
    mysqli_close($conn); // Close connection
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- things for calendar -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <title>CNU Rowing Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- For Button PopUp -->
    <style>
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
    <div class="center"><h1>CNU Rowing Club - Schedule</h1></div>    

    <div class="schedule">
        <div class="product"> 
            <!-- <div class="grid-container"> -->
                <back-button onclick="location.href='home.php';">
                    <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
                </back-button>
        </div>
                <div class="center">
                    <div id="createEventEboard" style="display:<?php echo $memberstatus == "e-board" ? 'block':'none' ?>"> 
                        <a class="buttonPop" href="#popup1">+ Create Event</a>
                        <p><br></p>
                        <div id="popup1" class="overlay">
                            <div class="popup">
                                <h2>New Event</h2>
                                <a class="close" href="#">&times;</a>
                                <div class="content">
                                    <form method="POST">
                                    Event Name : <input type="text" name="eventname" placeholder="Enter Event Name" Required value="<?php echo $eventname;?>">
                                    <br/>
                                    Date : <input type="datetime" name="eventdate" placeholder="Enter Date (YYYY-MM-DD hh:mm:ss)" Required value="<?php echo $eventdate;?>">
                                    <br/>
                                    Location : <input type="text" name="eventlocation" placeholder="Enter Location" Required value="<?php echo $eventlocation;?>">
                                    <br/>
                                    Description : <input type="text" name="eventdescription" placeholder="Enter Description" value="<?php echo $eventdescription;?>">
                                    <input type="submit" name="submit" value="Save">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="home-page">
                    <h1> Today's Events: </h1>
                    <table>
                        <tr>
                            <th>Event</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Description</th>
                        </tr>
                        <?php 
                            $date = date("Y-m-d");
                            // echo $date;

                            $conn = mysqli_connect("localhost", "root", "root", "rowing"); // Create connection

                            $sql = "SELECT eventname, eventlocation, substring(eventdate,12,5) as 'date', eventdescription 
                                    FROM event
                                    WHERE substring(eventdate,1,10) = '$date';";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["eventname"]. "</td><td>" . $row["date"] 
                                . "</td><td>" . $row["eventlocation"] . "</td><td>" . $row["eventdescription"] . "</td></tr>";
                            }
                            echo "</table>";
                            } else { echo "No Events Today"; }
                            $conn->close();
                        ?>
                    </table>
                    <br/>

                    <h1> Upcoming Events: </h1>
                    <table>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Description</th>
                        </tr>
                        <?php 
                            $date = date("Y-m-d");
                            // echo $date;

                            $conn = mysqli_connect("localhost", "root", "root", "rowing"); // Create connection

                            $sql = "SELECT eventname, eventlocation, substring(eventdate,1,10) as 'date', substring(eventdate,12,5) as 'time', eventdescription 
                                    FROM event
                                    WHERE substring(eventdate,1,10) > '$date';";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["eventname"]. "</td><td>" . $row["date"]. "</td><td>" . $row["time"] 
                                . "</td><td>" . $row["eventlocation"] . "</td><td>" . $row["eventdescription"] . "</td></tr>";
                            }
                            echo "</table>";
                            } else { echo "No Upcoming Events"; }
                            $conn->close();
                        ?>
                    </table>
                    <br/>

                    </div>
                <!-- </div> -->
            </div>
            <p><br></p>
        <!-- </div>  -->
            <div class="container">
                <!-- Calendar! -->
                <div class="calendar">
                    <div class="month">
                        <i class="fas fa-angle-left prev"></i>
                        <div class="date">
                            <h1></h1>
                            <p></p>
                        </div>
                        <i class="fas fa-angle-right next"></i>
                    </div>
                    <div class="weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="days"></div>
                </div>
            </div>
        <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="schedule.js"></script> 
</body>
