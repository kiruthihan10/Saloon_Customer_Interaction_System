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

echo "<table>
<tr>
<th>Name</th>
<th>Saloon</th>
<th>Phone Number</th>
</tr>";

$emp_id = $_GET["emp_id"];

include 'config.php';

$sql = "SELECT * FROM employee
INNER JOIN users ON users.User_ID = employee.User_ID
INNER JOIN saloon ON saloon.Saloon_ID =  employee.Saloon_ID
WHERE employee.UserID = '$emp_id'
";

$result = $conn->query($sql);
while($employee = $result->fetch_assoc()){

    echo "<tr>";
    echo "<td>" . $employee['Name'] . "</td>";
    echo "<td>" . $employee['Saloon_Name'] . "</td>";
    echo "<td>" . $employee['Phone_Number'] . "</td>";
    echo "</tr>";
  
}
echo "</table>";
?>
</body>
</html>