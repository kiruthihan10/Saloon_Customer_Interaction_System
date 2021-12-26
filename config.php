<?php
   $servername = "sql209.epizy.com";
   $username = "epiz_30671718";
   $password = "NgjQL0peh5zDWp";
   $dbname = "epiz_30671718_saloon_database";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>