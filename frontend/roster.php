<?php
    include_once '/db.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNU Rowing Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>  
    <div class="nav-bar"></div>

    <div class="center"><h1>CNU Rowing Club - Roster</h1></div>

    <div class="product">
        <div class="grid-container">
            <back-button onclick="location.href='index.php';">
                <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
            </back-button>
        </div>
    </div>

    <div id="roster">
        <div class="home-page">

            <div class="center"><h2>[Insert Roster here]</h2></div>
            <!-- <?php 
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
                    
                    echo 'Connected successfully <br>';


                    $sql = "SELECT memberid, membername FROM member";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "id: " . $row["memberid"]. " - Name: " . $row["membername"]. "<br>";
                    }
                    } else {
                    echo "0 results";
                    }
                    $conn->close();
                    
                    // mysqli_close($conn);
                    ?> -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="roster.js"></script> 
</body>