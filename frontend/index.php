<?php
    include_once '/db.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CNU Rowing Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../boostrap/css/bootstrap.css">
    <!-- bootstrap css -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- disables zooming on mobile, see what happens and get rid if needed -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- MDB -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"
    ></script>

</head>
<body>  

    <!-- Background image -->
    <!-- <div class="bg-image" style=" background-image: '../frontend/row2.jpeg';
    height: 100vh; "></div> -->
    <!-- Background image -->

    <div class="nav-bar"></div>

    <div class="center"><h1>CNU Rowing Club</h1></div>
    <div class="container-fluid">
    <div id="app">

        <div class="col-xs-1">
            <div class="product-image">
                <img v-bind:src="image"> 
            </div>    
        </div> 
        
            <div class="textarea">

                    <div class="center">
                    <div class="row">
                        <div class="col-xs-2">
                        <button onclick="location.href='../frontend/schedule.html';">Schedule</a></button>
                        </div>
                    </div>
                    <!-- </div>
                    <div class="center"> -->
                    <div class="row">
                        <div class="col-xs-3">
                        <button onclick="location.href='../frontend/roster.html';">Roster</a></button>
                        </div>
                    </div>
                    <!-- </div>
                    <div class="center">     -->
                    <div class="row">
                        <div class="col-xs-2">
                        <button onclick="location.href='../frontend/attendance.html';">Attendance</a></button>
                        </div>
                    </div>
                        <!-- </div>
                    <div class="center">     -->
                    <div class="row">
                        <div class="col-xs-2">
                        <button onclick="location.href='../frontend/settings.html';">Settings</a></button>
                        </div>
                    </div>
                    </div>

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
                    
                    echo 'Connected successfully';
                    
                    mysqli_close($conn);

                    $test = mysqli_query($conn, 'select * from member;');
                    
                    $conn;
                    $test;  ?>

            </div>       
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="app.js"></script> 
</body>

