<?php
    include 'payment_class.php';
    $payment = new payment(NULL);
    $payment->setsaloon($_POST["selected_saloon"]);
    $payment->setcash($_POST["Cost"]);
    $payment->setdate(date("Y-m-d"));
    $payment->addintodb();
    header("Location: saloon_payment.html");
    exit();
?>