<?php
   $servername = "sql6.freemysqlhosting.net";
   $username = "sql6458218";
   $password = "cuMmBigGTg";
   $dbname = "sql6458218";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>