<?php

// Create connection

$conn = mysqli_connect('localhost', 'rowingguy', 'password', 'rowing');

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo 'Connected successfully';

mysqli_close($conn);


?>