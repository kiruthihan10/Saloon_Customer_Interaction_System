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
include 'user_class.php';
session_start();
if($_SESSION["user_class"]=="customer")
{
  $user = new customer($_SESSION["uname"]);
}
else if($_SESSION["user_class"]=="employee")
{
  $user = new employee($_SESSION["uname"]);
}
$user->get_upcoming_appointments_from_db_as_table();

?>
</body>
</html>