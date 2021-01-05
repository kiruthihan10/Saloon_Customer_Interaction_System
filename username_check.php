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

$uname = $_GET["uname"];

include 'config.php';

$sql = "SELECT * FROM users WHERE User_ID = '$uname'";

$result = $conn->query($sql);
if ($result->num_rows!=0){
    echo "Username Already Taken";
}

?>
</body>
</html>