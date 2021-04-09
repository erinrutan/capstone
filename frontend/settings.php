<!-- SETTINGS PAGE -->
<?php
    session_start();
    $user = $_SESSION['user'];
    echo $user;

    $conn = mysqli_connect("localhost", "root", "root", "rowing");

    if(isset($_POST['save'])) {		

        $getuser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE memberid = '$user';"));
        $membername = $getuser["membername"];
        echo $membername;

        $membername = $_POST['membername'];
        $memberphoneno = $_POST['memberphoneno'];
        $memberemail = $_POST['memberemail'];
        $memberstatus = $_POST['memberstatus'];
        $membersiderow = $_POST['membersiderow'];
        $memberbio = $_POST['memberbio'];
        $memberpassword = $_POST['memberpassword'];
        $hash = password_hash($memberpassword, PASSWORD_DEFAULT);

        // $update = mysqli_query($conn,"UPDATE `member`
        // SET membername = '$membername', memberphoneno = '$memberphoneno', memberemail = '$memberemail',
        // memberstatus = '$memberstatus', membersiderow = '$membersiderow', memberbio = '$memberbio', memberpassword = '$hash'
        // WHERE memberid = $_SESSION['user'];");

        // if(!$update) {
        //     echo mysqli_error();
        // } else {
        //     echo "Successfully Updated";
        // }
    }

    if(isset($_POST['logout'])) {		
        $_SESSION['user'] = NULL;
        redirect('index.php');
    }

    if(isset($_POST['deleteAccount'])) {
        // $delete = mysqli_query($conn, "DELETE FROM member WHERE memberid = $_SESSION['user']");
        $_SESSION['user'] = NULL;
        redirect('index.php');
    }

    function redirect($url) {
      ob_start();
      header('Location: '.$url);
      ob_end_flush();
      die();
    }

    mysqli_close($conn); // Close connection

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
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

    <div class="center"><h1>CNU Rowing Club - Settings</h1></div>

    <div class="product">
        <div class="grid-container">
            <back-button onclick="location.href='home.php';">
                <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
            </back-button>
        </div>
    </div>

    <div id="settings">
        <div class="home-page">

            <div class="center">
            <form method="POST">
                Name: <input type="text" value=<?php echo $membername;?>>
                <br/>
                Phone Number: <input type="text" value="Phone Number">
                <br/>
                Email: <input type="text" value="Email">
                <br/>
                Status: <input type="text" value="Status">
                <br/>
                Side Row: <input type="text" value="Side">
                <br/>
                Password: <input type="text" value="Change [change this]">
                <br/>
                <button type="submit" name="save">Save</a></button>
                <p></p>
            </form>
            <form method="POST">
                <button type="submit" name="logout">Log Out</button>
                <br/>
            </form>
            <div class="box">
                    <a class="buttonPop" href="#popup1">Delete Account</a>
                </div>
                <div id="popup1" class="overlay">

                    <div class="popup">
                        <h2>Are you sure you want to delete your account?</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                        <form method="POST">
                            <button type="submit" name="deleteAccount">Yes</button>
                        </form>
                            <button onclick="location.href='settings.php';">No</button>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="settings.js"></script> 
</body>
