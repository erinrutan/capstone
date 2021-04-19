<!-- HOME PAGE -->
<?php
    include_once 'db.php';
    session_start();
    // echo $_SESSION['user'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
                            <button onclick="location.href='schedule.php';">Schedule</a></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <button onclick="location.href='roster.php';">Roster</a></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <button onclick="location.href='attendance.php';">Attendance</a></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <button onclick="location.href='settings.php';">Settings</a></button>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="app.js"></script> 
</body>

