<?php
    include 'config.php';
    $cost = $_POST["Cost"];
    $saloon = $_POST["selected_saloon"];
    $date = date("Y-m-d");

    $sql = "INSERT INTO payments (Saloon_ID,Price,Date_of_deposit) VALUES ('$saloon','$cost','$date')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>