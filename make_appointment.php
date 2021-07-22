<?php
    include_once 'appointment_class.php';
    include_once 'user_class.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $app = new apoointment(NULL);
        if(!isset($_POST["Time"])) {
            header("Location: make_appointment.html");
        }
        $app->setTime($_POST["Time"]);
        $app->setDate($_POST["Date"]);
        $service = $_POST["service"];
        $Hair_Cut = boolval(in_array('Hair_Cut', $service));
        if ($Hair_Cut){
            NULL;
        }
        else{
            $Hair_Cut=0;
        }
        $app->setHair_Cut($Hair_Cut);
        $Shave = in_array('Shave', $service);
        if ($Shave){
            NULL;
        }
        else{
            $Shave=0;
        }
        $app->setShave($Shave);
        $Massage = in_array('Massage', $service);
        if ($Massage){
            NULL;
        }
        else{
            $Massage=0;
        }
        $app->setMassage($Massage);
        $Dye = boolval(in_array('Dye', $service));
        if ($Dye){
            NULL;
        }
        else{
            $Dye=0;
        }
        $app->setdye($Dye);
        session_start();
        $app->set_customer($_SESSION["uname"]);
        if (!isset($_POST["selected_employee"]))
        {
            header("Location: make_appointment.html");
        }
        $app->set_employee($_POST["selected_employee"]);
        $app->addintodb();
        
        
        header("Location: customer_menu.html");
        exit();

    }
?>