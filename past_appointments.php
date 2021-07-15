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

include_once "user_class.php";
session_start();
if($_SESSION["user_class"]=="customer")
{
  $user = new customer($_SESSION["uname"]);
}
else if($_SESSION["user_class"]=="employee")
{
  $user = new employee($_SESSION["uname"]);
}
$uname = $_SESSION["uname"];
$user_class = $_SESSION["user_class"];
$d = date("y-m-d");
$t = date('H:i:s',time());
echo "Date is :";
echo $d;
echo "<br>";
echo "Time is :";
echo $t;

$user->get_past_appointments_from_db_as_table();

?>
</body>
</html>