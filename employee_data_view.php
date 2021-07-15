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
include 'user_class.php';
$user = new employee($_GET["emp_id"]);
$user->get_from_table();
$user->getfromdb();
$user->get_table_data();
echo "</table>";
?>
</body>
</html>