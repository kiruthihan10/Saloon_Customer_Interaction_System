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



echo "<table>
  <tr>
  <th>Saloon Name</th>
  <th>Saloon Payment Balance</th>
  <th>Make Payment</th>
  
  </tr>";
    include "user_class.php";
    $user = new admin($_SESSION["uname"]);
    $user->add_saloons_from_db();
    $user->get_saloon_details_table();
    

echo "</table>";
?>
</body>
</html>