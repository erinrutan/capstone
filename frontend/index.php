<!-- LOGIN PAGE -->
<?php
  session_start();
  echo $_SESSION['user'];
    // $hash = password_hash($givenPassword, PASSWORD_DEFAULT);
    // $verify = password_verify($inputPassword, $hash);

    // Create connection
    $conn = mysqli_connect("localhost", "root", "root", "rowing");

    if(isset($_POST['submit']))
    {		
        $membername = $_POST['membername'];
        $memberphoneno = $_POST['memberphoneno'];
        $memberemail = $_POST['memberemail'];
        $memberstatus = $_POST['memberstatus'];
        $membersiderow = $_POST['membersiderow'];
        $memberbio = $_POST['memberbio'];
        $memberpassword = $_POST['memberpassword'];
        $hash = password_hash($memberpassword, PASSWORD_DEFAULT);

        $insert = mysqli_query($conn,"INSERT INTO `member`
        VALUES (NULL,'$membername','$memberphoneno','$memberemail','$memberstatus','$membersiderow','$memberbio','$hash');");

        if(!$insert) {
            echo mysqli_error();
        } else {
            echo "Account created";
        }
    }

    if(isset($_POST['login']))
    {		
      $inputpassword = $_POST['inputpassword'];
      $inputemail = $_POST['inputemail'];

      $getdbPassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT memberpassword FROM member WHERE memberemail = '$inputemail';"));
      $dbPassword = $getdbPassword["memberpassword"];

      $getuserid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT memberid FROM member WHERE memberemail = '$inputemail';"));
      $userid = $getuserid["memberid"];
      // [[ CAN CHECK HERE IF ACCOUNT EXISTS, IF NO USER ID NO ACCOUNT ]]
       
      if (password_verify($inputpassword, $dbPassword)) {
        $_SESSION['user'] = $userid;
        echo "SUCCESS, PASSWORDS MATCH. ACCOUNT VALID";
        redirect("home.php");
      } else {
        echo "INCORRECT EMAIL OR PASSWORD";
      }
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>CNU Rowing Club</title>
    <!-- For Button PopUp -->
    <style>
        .buttonPop {
            font-size: 1em;
            padding: 10px;
            color: #fff;
            border: 2px solid #06D85F;
            border-radius: 20px/50px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease-out;
            background: #06D85F;
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

<div class='grid-container'>
<div class="product-image">
  <img src="logo.jpg" alt="Rowing Club Logo">
</div>

  <div class="center">
  <form method="POST">
    Email    : <input type="text" name="inputemail" placeholder="Enter Email" Required value="<?php echo $inputemail;?>">
    <br/>
    Password : <input type="varchar(225)" name="inputpassword" placeholder="Enter Password" Required value="<?php echo $inputpassword;?>">
    <br/>          
    <button type="submit" name="login">Sign in</button>
  </form>
  </div>

<div class="center">
  <button onclick="location.href='home.php';">Bypass</a></button>
  <p><br></p>
  <a class="buttonPop" href="#popup1">CREATE ACCOUNT</a>

  <div id="popup1" class="overlay">
    <div class="popup">
      <h2>Create Account</h2>
      <a class="close" href="#">&times;</a>
      <div class="content">
        <form method="POST">
          Name         : <input type="text" name="membername" placeholder="Enter Name" Required value="<?php echo $membername;?>">
          <br/>
          Email        : <input type="text" name="memberemail" placeholder="Enter Email" Required value="<?php echo $memberemail;?>">
          <br/>
          Password     : <input type="varchar(225)" name="memberpassword" placeholder="Enter Password" Required value="<?php echo $memberpassword;?>">
          <br/>
          Phone Number : <input type="text" name="memberphoneno" placeholder="Enter Phone Number" Required value="<?php echo $memberphoneno;?>">
          <br/>
          Status :
            <input type="radio" name="memberstatus"
            <?php if (isset($status) && $status=="e-board") echo "checked";?>
            value="e-board">E-board
            <input type="radio" name="memberstatus" Required
            <?php if (isset($status) && $status=="member") echo "checked";?>
            value="member">Member
          <br/>
          Side   : 
            <input type="radio" name="membersiderow" 
            <?php if (isset($siderow) && $siderow=="port") echo "checked";?>
            value="port">Port
            <input type="radio" name="membersiderow"
            <?php if (isset($siderow) && $siderow=="starboard") echo "checked";?>
            value="starboard">Starboard
            <input type="radio" name="membersiderow"
            <?php if (isset($siderow) && $siderow=="coxswain") echo "checked";?>
            value="coxswain">Coxswain
          <br/>
          Bio    : <input type="textarea" name="memberbio" placeholder="Enter Bio" value="<?php echo $memberbio;?>">
          <br/>
          <input type="submit" name="submit" value="Save">
        </form>
      </div>
    </div>
  </div>
                
</div>
</div>
</div>

</body>