<?php
    session_start();
    include_once "user_class.php";
    $user = new customer($_SESSION["uname"]);
    echo $user->get_rating();
    
?>