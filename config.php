<?php
   //Change server details as you wish
   $servername = "YOUR_SERVER_NAME_HERE";
   $username = "root";
   $password = "";
   $dbname = "DATABASE_NAME_HERE";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo '<script>alert("Connected successfully")</script>';
?>
