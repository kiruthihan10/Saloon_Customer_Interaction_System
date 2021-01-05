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


session_start();
$uname = $_SESSION["uname"];

include 'config.php';


  echo "<table>
  <tr>
  <th>Saloon Name</th>
  <th>Saloon Payment Balance</th>
  <th>Balance</th>
  
  </tr>";
    $sql = "SELECT * FROM saloon
    WHERE saloon.Agent_ID='$uname'";
    $share = 0.1;
    $result = $conn->query($sql);
    if ($result->num_rows>0){
        while ($saloon = $result->fetch_assoc()){
            $sid = $saloon["Saloon_ID"];
            $payment = 0;
            $saloon_sql = "SELECT * FROM payments WHERE Saloon_ID =  '$sid'";
            $saloon_result = $conn->query($saloon_sql);
            if ($saloon_result->num_rows>0){
                while ($saloon_payment=$saloon_result->fetch_assoc()){
                    $payment=$payment+$saloon_payment["Price"];
                }
            }
            $saloon_sql = "SELECT * FROM appointment
            INNER JOIN employee ON employee.User_ID = appointment.employee_ID
            WHERE employee.Saloon_ID = '$sid'";
            $saloon_result = $conn->query($saloon_sql);
            if ($saloon_result->num_rows>0){
                while ($saloon_payment=$saloon_result->fetch_assoc()){
                    $payment=$payment-$saloon_payment["hair_cut"]*150*$share;
                    $payment=$payment-$saloon_payment["shave"]*100*$share;
                    $payment=$payment-$saloon_payment["Massage"]*75*$share;
                    $payment=$payment-$saloon_payment["dye"]*200*$share;
                }
            }
            echo "<tr>";
            echo "<td>" . $saloon['Saloon_Name'] . "</td>";
            echo "<td>" . $payment . "</td>";
            echo "<td><input type='radio' name='selected_saloon' value=" . $saloon['Saloon_ID'] . "></input></td>";
            echo "</tr>";
        }
    
    }

echo "</table>";
?>
</body>
</html>