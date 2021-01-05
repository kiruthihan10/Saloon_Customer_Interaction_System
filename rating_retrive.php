<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
  color: white;
}

table, td, th {
  border: 1px solid white;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php


session_start();
$uname = $_SESSION["uname"];
$user_class = $_SESSION["user_class"];

include 'config.php';

if ($user_class=="employee"){
  $sql = "SELECT * FROM employee
  INNER JOIN appointment ON appointment.employee_ID = employee.User_ID
  WHERE employee.User_ID='$uname'";
  $result = $conn->query($sql);
  $rating = 0;
  $num_of_appointments = 0;
  while ($data = $result->fetch_assoc()){
    $rating = $rating+$data["employee_rating"];
    $num_of_appointments = $num_of_appointments+1;
  }
  echo $rating/$num_of_appointments;
}
else{
  $sql = "SELECT * FROM customer
  INNER JOIN appointment ON appointment.customer_ID = customer.User_ID
  WHERE customer.User_ID='$uname'";
  $result = $conn->query($sql);
  $rating = 0;
  $num_of_appointments = 0;
  while ($data = $result->fetch_assoc()){
    $rating = $rating+$data["customer_rating"];
    $num_of_appointments = $num_of_appointments+1;
  }
  echo $rating/$num_of_appointments;
}

?>
</body>
</html>