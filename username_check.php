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
include "user_class.php";
$user = new user($_GET["uname"]);
if ($user->is_user())
{
  echo "Username Already Taken";
}

?>
</body>
</html>