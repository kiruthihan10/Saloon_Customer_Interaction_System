<?php
    session_start();
    $uname = $_SESSION["uname"];
    $sql = "SELECT * FROM customer WHERE User_ID='$uname'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
     echo $row["Saloon_ID"];
    }
?>