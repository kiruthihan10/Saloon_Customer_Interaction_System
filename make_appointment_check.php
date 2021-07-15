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
  $date = $_GET["Date"];
  $date = date('Y-m-d',strtotime($date));
  $appointment_time = $_GET["Time"];
  $location = $_GET["Location"];
  $rating = $_GET["Rating"];
  $shave = $_GET["Shave"];
  $dye = $_GET["Dye"];
  $hair_cut = $_GET["Hair_Cut"];
  $massage = $_GET["Massage"];

  include 'config.php';
  include_once 'user_class.php';
  $today = date('Y-m-d');
  if ($date>$today){
    echo "<table>
    <tr>
    <th>Name</th>
    <th>Rating</th>
    <th>Saloon</th>
    </tr>";
    $sql = "SELECT * FROM employee
    INNER JOIN users ON users.User_ID = employee.User_ID
    INNER JOIN saloon ON saloon.Saloon_ID =  employee.Saloon_ID
    INNER JOIN appointment ON employee.User_ID = appointment.employee_ID
    WHERE saloon.Location = '$location' GROUP BY (employee.User_ID)
    HAVING AVG(appointment.employee_rating) >= '$rating'
    ORDER BY AVG(appointment.employee_rating)
    ";
    $result = $conn->query($sql);
    while($employee = $result->fetch_assoc()){
      $emp_id = $employee['User_ID'];
      $emp = new employee($emp_id);


      $sql = "SELECT * FROM appointment WHERE dop = '$date' AND employee_ID = '$emp_id'";

      $app_result = $conn->query($sql);
      $available = True;
      if ($app_result->num_rows > 0){
        while($row = $app_result->fetch_assoc() AND $available) {
          $time = 0;
          if ($row["hair_cut"]){
            $time += 30;
          }
          if ($row["shave"]){
            $time += 10;
          }
          if ($row["Massage"]){
            $time += 15;
          }
          if ($row["dye"]){
            $time += 20;
          }

          if(((strtotime(strtotime($appointment_time) - $row["toa"]))>$time*60)==1) {}
          else{
            $available=false;
          }
          $expected_time = 0;
          if ($hair_cut){
            $expected_time += 30;
          }
          if ($shave){
            $expected_time += 10;
          }
          if ($massage){
            $expected_time += 15;
          }
          if ($dye){
            $expected_time += 20;
          }
          if(((strtotime($row["toa"]-strtotime($appointment_time)))> $expected_time*60)==1) {}
          else{
            $available=false;
          }
        }
      }
      
      if ($available){
        echo "<tr>";
        echo "<td>" . $employee['Name'] . "</td>";
        echo "<td>" . $employee['employee_rating'] . "</td>";
        echo "<td>" . $employee['Saloon_Name'] . "</td>";
        echo "<td><input type='radio' name='selected_employee' value=" . $employee['User_ID'] . "></input></td>";
        echo "</tr>";
      }

    }
    echo "</table>";
  }
  else{
    echo "Select Date from Tomorrow";
  }


?>
</body>
</html>