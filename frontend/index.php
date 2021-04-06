<!-- LOGIN PAGE -->
<?php
    // $hash = password_hash("password", PASSWORD_DEFAULT);
    // $password = "password";
    // echo $hash;
    // $verify = password_verify($password, $hash);
    // echo "";
    // echo $verify;


    // Create connection
    $conn = mysqli_connect("localhost", "root", "root", "rowing");

    // /* A sanitization check for the account password */
    // public function isPasswdValid(string $memberpassword): bool
    // {
    //   /* Initialize the return variable */
    //   $valid = TRUE;
      
    //   /* Example check: the length must be between 8 and 16 chars */
    //   $len = mb_strlen($passwd);
    //   if (($len < 8) || ($len > 16))
    //   { $valid = FALSE; }
      
    //   /* add more checks here */
      
    //   return $valid;
    // }

    if(isset($_POST['submit']))
    {		
        $membername = $_POST['membername'];
        $memberphoneno = $_POST['memberphoneno'];
        $memberemail = $_POST['memberemail'];
        $memberstatus = $_POST['memberstatus'];
        $membersiderow = $_POST['membersiderow'];
        $memberbio = $_POST['memberbio'];
        $hash = password_hash('memberpassword',PASSWORD_DEFAULT);
        $memberpassword = $_POST[$hash];
        // $memberpassword = $_POST['memberpassword'];

        // [[ CHECK THAT PASSWORD IS VALID ]]
        // [[ CHECK INPUTS / SANITIZE AGAINST SQL ATTACKS ]]

        $insert = mysqli_query($conn,"INSERT INTO `member`
        VALUES (NULL,'$membername','$memberphoneno','$memberemail','$memberstatus','$membersiderow','$memberbio','$memberpassword');");

        if(!$insert)
        {
            echo mysqli_error();
        }
        else
        {
            echo "Account created";
        }
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

    <!-- Background image
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8"> -->
              <div class="center">
              <form class="bg-white rounded shadow-5-strong p-5"> 
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form1Example1" class="form-control" />
                  <label class="form-label" for="form1Example1">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form1Example2" class="form-control" />
                  <label class="form-label" for="form1Example2">Password</label>
                </div>

              

                <!-- Sign in button -->
                <button type="submit" class="btn btn-primary btn-block" onclick="location.href='home.php';">Sign in</button>
              </form>
              </div>
            <!-- </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Background image -->

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
          Status       : <!-- <input type="text" name="memberstatus" placeholder="Enter Postiion [[CHANGE TO BUTTONS]]"> -->
            <input type="radio" name="memberstatus"
            <?php if (isset($status) && $status=="e-board") echo "checked";?>
            value="e-board">E-board
            <input type="radio" name="memberstatus"
            <?php if (isset($status) && $status=="member") echo "checked";?>
            value="member">Member
          <br/>
          Side         : <!--<input type="text" name="membersiderow" placeholder="Enter Side Rowed" Required> -->
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
          Bio          : <input type="textarea" name="memberbio" placeholder="Enter Bio" value="<?php echo $memberbio;?>">
          <br/>
          <input type="submit" name="submit" value="Save">
        </form>
      </div>
    </div>
  </div>
                
</div>
</div>
<!-- grid container -->
</div>

</body>