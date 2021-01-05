<?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $uname = $_POST["username"];
      $pw = $_POST["password"];
      $pw = password_hash($pw,PASSWORD_DEFAULT);
      $salary = $_POST["salary"];
      session_start();
      $saloon = $_SESSION["saloon"];
      
      $sql = "UPDATE Users (Password) VALUES ('$pw') WHERE User_ID = '$uname'";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $sql = "UPDATE employee SET (Salary) VALUES ('$salary') WHERE User_ID = '$uname'";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
      #header("Location: login_page.html");
      #exit();

    }
?>