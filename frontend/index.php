<!-- LOGIN PAGE -->
<?php

    // echo password_hash("password", PASSWORD_DEFAULT);
    // Create connection
    $conn = mysqli_connect("localhost", "root", "root", "rowing");

    if(isset($_POST['submit']))

    // `memberid`, `membername`, `memberphoneno`, `memberemail`, 
    // `memberstatus`, `membersiderow`, `memberbio`
    {		
        $membername = $_POST['membername'];
        $memberphoneno = $_POST['memberphoneno'];
        $memberemail = $_POST['memberemail'];
        $memberstatus = $_POST['memberstatus'];
        $membersiderow = $_POST['membersiderow'];
        $memberbio = $_POST['memberbio'];
        $memberpassword = $_POST[password_hash('memberpassword',PASSWORD_DEFAULT)];

        $insert = mysqli_query($conn,"INSERT INTO `member`
        VALUES (NULL,'$membername','$memberphoneno','$memberemail','$memberstatus','$membersiderow','$memberbio');");

        if(!$insert)
        {
            echo mysqli_error();
        }
        else
        {
            echo "Records added successfully.";
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
      <h2>New Event</h2>
      <a class="close" href="#">&times;</a>
      <div class="content">
        <form method="POST">
          Name         : <input type="text" name="membername" placeholder="Enter Name" Required>
          <br/>
          Phone Number : <input type="text" name="memberphoneno" placeholder="Enter Phone Number" Required>
          <br/>
          Email        : <input type="text" name="memberemail" placeholder="Enter Email" Required>
          <br/>
          Status       : <input type="text" name="memberstatus" placeholder="Enter Postiion [[CHANGE TO BUTTONS]]">
          <br/>
          Side         : <input type="text" name="membersiderow" placeholder="Enter Side Rowed" Required>
          <br/>
          Bio          : <input type="text" name="memberbio" placeholder="Enter Bio" >
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