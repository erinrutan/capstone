<!doctype html>
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
    <div class="nav-bar"></div>

    <div class="center"><h1>CNU Rowing Club - Settings</h1></div>

    <div class="product">
        <div class="grid-container">
            <back-button onclick="location.href='index.php';">
                <back-img><img src="back_button.png" id="home" width="100" height="100" /></back-img></a>
            </back-button>
        </div>
    </div>

    <div id="settings">
        <div class="home-page">

            <div class="center">

                <p>Name: <input type="text" value="Name"></p>
                <p>Phone Number: <input type="text" value="Phone Number"></p>
                <p>Email: <input type="text" value="Email"></p>
                <p>Status: <input type="text" value="Status"></p>
                <p>Side Row: <input type="text" value="Side"></p>
                <p>Password: <input type="text" value="Change [change this]"></p>

                <button onclick="location.href='index.php';">Save</a></button>
                <p></p>
                <button>Log Out</button>
                <p><br></p>
 


                <div class="box">
                    <a class="buttonPop" href="#popup1">Delete Account</a>
                </div>
                <div id="popup1" class="overlay">

                <div class="popup">
                    <h2>Are you sure you want to delete your account?</h2>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <button>Yes</button>
                        <button onclick="location.href='settings.php';">No</button>
                    </div>
                </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="settings.js"></script> 
</body>
</html>