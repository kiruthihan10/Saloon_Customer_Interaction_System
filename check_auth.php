<?php
    session_start();
    if (isset($_SESSION['uname'])) {
        echo "1";
    }
    else {
        echo "0";
    }
?>