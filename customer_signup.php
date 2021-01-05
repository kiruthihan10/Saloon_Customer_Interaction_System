<?php
    include 'config.php';
    include 'data_preprocessing.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $uname = text_preprocessing(strtolower($_POST["username"]));
      $pw = $_POST["password"];
      $pw = password_hash($pw,PASSWORD_DEFAULT);
      $name = text_preprocessing($_POST["Name"]);
      $phoneno = text_preprocessing($_POST["PhoneNum"]);
      $mail = text_preprocessing($_POST["email"]);

      $sql = "SELECT * FROM users WHERE User_ID = '$uname'";

      $result = $conn->query($sql);
      if ($result->num_rows!=0){
          header('customer_signup.html');
          exit();
      }
      $sql = "INSERT INTO Users (User_ID,Pword,Name,Phone_Number) VALUES ('$uname','$pw','$name','$phoneno')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $sql = "INSERT INTO customer (User_ID,email) VALUES ('$uname','$mail')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
      //header("Location: login_page.html");
      //exit();

    }
?>