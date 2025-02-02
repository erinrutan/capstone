<!-- SETTINGS PAGE -->
<?php
    session_start();
    $user = $_SESSION['user'];
    // echo $user;

    $conn = mysqli_connect('localhost', 'rowingguy', 'password', 'rowing'); // Create connection

    $getuser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE memberid = '$user';"));
    $membername = $getuser["membername"];
    $memberphoneno = $getuser["memberphoneno"];
    $memberemail = $getuser["memberemail"];
    $memberstatus = $getuser["memberstatus"];
    $membersiderow = $getuser["membersiderow"];
    $memberbio = $getuser["memberbio"];

    if(isset($_POST['save'])) {
        $membername = $_POST['membername'];
        $memberphoneno = $_POST['memberphoneno'];
        $memberemail = $_POST['memberemail'];
        $memberstatus = $_POST['memberstatus'];
        $membersiderow = $_POST['membersiderow'];
        $memberbio = $_POST['memberbio'];

        $update = mysqli_query($conn,"UPDATE `member`
        SET membername = '$membername', memberphoneno = '$memberphoneno', memberemail = '$memberemail',
        memberstatus = '$memberstatus', membersiderow = '$membersiderow', memberbio = '$memberbio'
        WHERE memberid = $user;");

        if(!$update) {
            echo mysqli_error();
        } else {
            echo "Successfully Updated";
        }
    }

    if(isset($_POST['changePassword'])) {
        $inputpassword = $_POST['inputpassword'];
        $memberpassword = $_POST['memberpassword'];
        $memberpasswordCHECK = $_POST['memberpasswordCHECK'];

        $getdbPassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT memberpassword FROM member WHERE memberid = $user;"));
        $dbPassword = $getdbPassword["memberpassword"];

        if ($memberpassword == $memberpasswordCHECK ) {
            if (password_verify($inputpassword, $dbPassword)) {
                $hash = password_hash($memberpassword, PASSWORD_DEFAULT);
                $update = mysqli_query($conn, "UPDATE `member` SET memberpassword = '$hash' WHERE memberid = $user;");
                if (!$update) {
                    echo mysqli_error();
                } else {
                    redirect('settings.php');
                    echo "Password Changed";
                }
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Incorrect current password.");'; 
                echo '</script>';
            }
        }
        else {
            echo '<script type="text/javascript">';
            echo 'alert("New passwords do not match.");'; 
            echo '</script>';
        }
    }

    if(isset($_POST['logout'])) {		
        $_SESSION['user'] = NULL;
        redirect('index.php');
    }

    if(isset($_POST['deleteAccount'])) {
        $delete = mysqli_query($conn, "DELETE FROM member WHERE memberid = $user");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>CNU Rowing Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">


    <style>
        form  { display: table;
                margin: 0 auto; }
        p     { display: table-row; }
        label { display: table-cell; }
        input { display: table-cell; }
    </style>
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

    <div class="container-fluid">
    <div id="app">
    <div class="col-xs-1">
        <div class="product">
            <back-button onclick="location.href='home.php';">
                <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
            </back-button>
        </div>
    </div>
    <script>
    var mName = <?php echo $membername;?>;
    </script>
    <div class="col-xs-2">
    <div id="settings">
        <div class="textarea">
            <div class="center">
                <form method="POST">
                    <p>
                    <label>Name:</label> <input type="text" name="membername" value='<?php echo $membername;?>'>
                    </p>
                    <br/>
                    <p>
                    <label>Phone Number:</label> <input type="text" name="memberphoneno" value=<?php echo $memberphoneno;?>>
                    </p>
                    <br/>
                    <p>
                    <label>Email:</label> <input type="text" name="memberemail" value=<?php echo $memberemail;?>>
                    <br/>
                    </p>
                    <br/>
                    <p>
                    <label>Status :</label>
                        <input type="radio" name="memberstatus" 
                        <?php if ($memberstatus == "e-board") echo "checked";?> 
                        
                        value="e-board">E-board
                        <input type="radio" name="memberstatus" Required
                        <?php if ($memberstatus == "member") echo "checked";?>
                        value="member">Member
                    </p>
                    <br/>
                    <p>
                    <label>Side   : </label>
                        <input type="radio" name="membersiderow" 
                        <?php if ($membersiderow == "port") echo "checked";?>
                        value="port">Port
                        <input type="radio" name="membersiderow"
                        <?php if ($membersiderow == "starboard") echo "checked";?>
                        value="starboard">Starboard
                        <input type="radio" name="membersiderow"
                        <?php if ($membersiderow == "coxswain") echo "checked";?>
                        value="coxswain">Coxswain
                    </p>
                    <br/>
                    <!-- <div class="box"> -->
                    <p><label> </label>
                    <input type="submit" name="save" class="buttonPop" href="#popup1" value="Save Changes">
                    </p>
                    <br/>
                    <p><label> </label>
                        <a class="buttonPop" href="#popup1">Change password</a>
                    </p>
                    <br/><br/>
                    <p><label> </label>
                        <a class="buttonPop" href="#popup2">Log Out</a>
                    </p>
                    <br/><br/>
                    <p><label> </label>
                        <a class="buttonPop" href="#popup3">Delete Account</a>
                    </p>
                </form>
            </div>
            <!-- <br/>
            <div class="box">
                <a class="buttonPop" href="#popup1">Change password</a>
            </div> -->
            <div id="popup1" class="overlay">
                <div class="popup">
                    <h2>Enter a new password</h2>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <form method="POST">
                            <p>
                            <label>Confirm Current Password:</label> <input type="password" name="inputpassword" placeholder="Enter Current Password" Required value="<?php echo $inputpassword;?>">
                            </p>
                            <br/>
                            <p>
                            <label>New Password:</label> <input type="password" name="memberpassword" minlength='8' placeholder="Enter New Password" Required value="<?php echo $memberpassword;?>">
                            </p>
                            <br/>
                            <p>
                            <label>Confirm New Password:</label> <input type="password" name="memberpasswordCHECK" minlength='8' placeholder="Must match" Required value="<?php echo $memberpasswordCHECK;?>">
                            </p>
                            <br/>
                            <p> <label> </label>
                            <input type="submit" class='buttonPop' name="changePassword" value="Save">
                            </p>
                            <br/>
                        </form>
                    </div>
                </div>  
            </div>
            <br/><br/>
            <!-- <div class="box">
                <a class="buttonPop" href="#popup2">Log Out</a>
            </div> -->
            <div id="popup2" class="overlay">
                <div class="popup">
                    <h2>Are you sure you want to log out?</h2>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <form method="POST">
                            <button type="submit" name="logout">Yes</button>
                            <br/>
                        
                            <!-- <button onclick="location.href='settings.php';">No</button> -->
                        </form>
                    </div>
                </div>  
            </div>
            <br/><br/>
            <!-- <div class="box">
                    <a class="buttonPop" href="#popup3">Delete Account</a>
                </div> -->
                <div id="popup3" class="overlay">

                    <div class="popup">
                        <h2>Are you sure you want to delete your account?</h2>
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                        <form method="POST">
                            <button type="submit" name="deleteAccount">Yes</button>
                            <!-- <button onclick="location.href='settings.php';">No</button> -->
                        </form>
                        </div>
                    </div>  
                </div>
            </div>
            <br/>
        </div>
    </div>    
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="settings.js"></script> 
</body>
