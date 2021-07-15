<?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start();
        $user_class = $_SESSION["user_class"];
        $rating = $_POST["rating"];
        if ($rating>5){
            $rating=5;
        }
        else if($rating<0){
            $rating=0;
        }
        $appointment_ID = $_POST["selected_appointment"];
        $userclas = $_SESSION["user_class"];
        if ($user_class=="customer"){
            echo "customer";
            $sql = "UPDATE appointment SET employee_rating = '$rating' WHERE AppointmentID = '$appointment_ID'";
            if ($conn->query($sql) === TRUE) {
                echo "record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
        } 
        else if ($user_class=="employee")
        {
            $sql = "UPDATE appointment SET customer_rating = '$rating' WHERE AppointmentID = '$appointment_ID'";
            if ($conn->query($sql) === TRUE)
            {
                echo "record updated successfully";
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        header("Location: View_past_appointments.html");
        exit(); 
        
        
        
        //header("Location: view_past_appointment.html");
        //exit();

    }

    $conn->close();
?>