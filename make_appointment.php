<?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $distric = $_POST["District"];
        $Time = $_POST["Time"];
        $Date = $_POST["Date"];
        $service = $_POST["service"];
        $Hair_Cut = boolval(in_array('Hair_Cut', $service));
        if ($Hair_Cut){
            NULL;
        }
        else{
            $Hair_Cut=0;
        }

        $Shave = in_array('Shave', $service);
        if ($Shave){
            NULL;
        }
        else{
            $Shave=0;
        }
        $Massage = in_array('Massage', $service);
        if ($Massage){
            NULL;
        }
        else{
            $Massage=0;
        }
        $Dye = boolval(in_array('Dye', $service));
        if ($Dye){
            NULL;
        }
        else{
            $Dye=0;
        }
        session_start();
        $customer_ID = $_SESSION["uname"];
        $employee_ID = $_POST["selected_employee"];
        $sql = "INSERT INTO appointment (customer_ID,dop,dye,employee_ID,hair_cut,Massage,shave,toa) VALUES ('$customer_ID','$Date','$Dye','$employee_ID','$Hair_Cut','$Massage','$Shave','$Time')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
        header("Location: customer_menu.html");
        exit();

    }
?>