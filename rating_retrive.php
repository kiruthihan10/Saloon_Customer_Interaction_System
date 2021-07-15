<!DOCTYPE html>
<html>
<body>

<?php

include "user_class.php";

session_start();
$user_class = $_SESSION["user_class"];
if($user_class=="employee")
{
  $user = new employee($_SESSION["uname"]);
}
else
{
  $user = new customer($_SESSION["uname"]);
}
echo round($user->get_rating(),3);

?>
</body>
</html>