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

if ($user_class =="customer"){
  echo "<table>
  <tr>
  <th>Date</th>
  <th>Time</th>
  <th>Designer Name</th>
  <th>Saloon Name</th>
  <th>Saloon Phone Number</th>
  <th>Hair Cut</th>
  <th>Shave</th>
  <th>Massage</th>
  <th>Dye</th>
  </tr>";
    $sql = "SELECT appointment.dop, appointment.toa, appointment.hair_cut,users.name,appointment.shave,appointment.Massage,appointment.dye,saloon.Phone_Number, users.Name,saloon.Saloon_Name
    FROM appointment
    INNER JOIN users ON users.User_ID = appointment.employee_ID
    INNER JOIN employee ON appointment.employee_ID = employee.User_ID
    INNER JOIN saloon ON employee.Saloon_ID = saloon.Saloon_ID
    WHERE appointment.customer_ID='$uname'
    AND
    appointment.dop>=CURDATE()
    ORDER BY appointment.dop";
    $result = $conn->query($sql);
    if ($result->num_rows>0){
      while ($appointment = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $appointment['dop'] . "</td>";
        echo "<td>" . $appointment['toa'] . "</td>";
        echo "<td>" . $appointment['Name'] . "</td>";
        echo "<td>" . $appointment['Saloon_Name'] . "</td>";
        echo "<td>" . $appointment['Phone_Number'] . "</td>";
        echo "<td>" . $appointment['hair_cut'] . "</td>";
        echo "<td>" . $appointment['shave'] . "</td>";
        echo "<td>" . $appointment['Massage'] . "</td>";
        echo "<td>" . $appointment['dye'] . "</td>";
        echo "</tr>";
    }
    }
    
}
else if ($user_class =="employee"){
  echo "<table>
  <tr>
  <th>Date</th>
  <th>Time</th>
  <th>Client's Name</th>
  <th>Client's Phone Number</th>
  <th>Hair Cut</th>
  <th>Shave</th>
  <th>Massage</th>
  <th>Dye</th>
  </tr>";
  $sql = "SELECT appointment.dop, appointment.toa, appointment.hair_cut, appointment.shave,appointment.Massage,appointment.dye, users.Name,users.Phone_Number
  FROM appointment
  INNER JOIN users ON users.User_ID = appointment.customer_ID
  WHERE appointment.employee_ID='$uname'
  ORDER BY appointment.dop";
  $result = $conn->query($sql);
  while ($appointment = $result->fetch_assoc()){
      echo "<tr>";
      echo "<td>" . $appointment['dop'] . "</td>";
      echo "<td>" . $appointment['toa'] . "</td>";
      echo "<td>" . $appointment['Name'] . "</td>";
      echo "<td>" . $appointment['Phone_Number'] . "</td>";
      echo "<td>" . $appointment['hair_cut'] . "</td>";
      echo "<td>" . $appointment['shave'] . "</td>";
      echo "<td>" . $appointment['Massage'] . "</td>";
      echo "<td>" . $appointment['dye'] . "</td>";
      echo "</tr>";
  }
}

echo "</table>";
?>
</body>
</html>