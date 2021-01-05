<?php
    include 'config.php';
    include 'data_preprocessing.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $uname = text_preprocessing(strtolower($_POST["username"]));
      $pw = $_POST["password"];
      $sql = "SELECT * FROM users WHERE User_ID='$uname'";
      $result = $conn->query($sql);
      if ($result->num_rows>0){
        $result = $result->fetch_assoc();
        $hash = $result["Pword"];
        if (password_verify($pw,$hash)){
        $sql = "SELECT * FROM employee WHERE User_ID='$uname'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          session_start();
          $_SESSION["uname"] = $uname;
          $_SESSION["user_class"]="employee";
          $sql = "SELECT Saloon_ID FROM employee WHERE User_ID='$uname'";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            $_SESSION["saloon"]=$row["Saloon_ID"];
          }
          
          header("Location: Employee_interface.html");
          exit();
        } else{
          $sql = "SELECT * FROM customer WHERE User_ID='$uname'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            session_start();
            $_SESSION["uname"] = $uname;
            $_SESSION["user_class"]="customer";
            $sql = "SELECT * FROM users WHERE User_ID='$uname'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
              $rating = $row["rating"];
            }
            $_SESSION["rating"] = $rating;
            header("Location: customer_menu.html");
            exit();
          } else{
            $sql = "SELECT * FROM system_admins WHERE User_ID='$uname'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              session_start();
              $_SESSION["uname"] = $uname;
              $_SESSION["user_class"]="system_admins";
              header("Location: admin_menu.html");
              exit();
            } else{
              echo '<script>alert("Wrong User Name or Password")</script>';
              header("Location: login_page.html");
              exit();
            }

        session_start();
        $_SESSION["uname"] = $uname;
        //header("Location: login_page.html");
        //exit();
      }
    }
  }
}
  echo '<script>alert("Wrong User Name or Password")</script>';
  //header("Location: login_page.html");
  //exit();
}
?>