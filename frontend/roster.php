<!-- ROSTER PAGE -->
<?php
    include_once 'db.php';
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
    <div class="center"><h1>CNU Rowing Club - Roster</h1></div>

    <div class="product">
        <div class="grid-container">
            <back-button onclick="location.href='home.php';">
                <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
            </back-button>
        </div>
    </div>

    <div id="roster">
        <div class="home-page">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Side</th>
                    <th>Biography</th>
                </tr>
                <?php 
                    $conn = mysqli_connect('localhost', 'rowingguy', 'password', 'rowing'); // Create connection

                    $sql = "SELECT membername, memberphoneno, memberemail, memberstatus, membersiderow, memberbio FROM member";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["membername"]. "</td><td>" . $row["memberphoneno"] 
                        . "</td><td>" . $row["memberemail"] . "</td><td>" . $row["memberstatus"] 
                        . "</td><td>" . $row["membersiderow"] . "</td><td>" . $row["memberbio"] . "</td></tr>";
                    }
                    echo "</table>";
                    } else { echo "0 results"; }
                    $conn->close();
                ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="roster.js"></script> 
</body>