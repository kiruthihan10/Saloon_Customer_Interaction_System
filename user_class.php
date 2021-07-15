<?php
    include_once 'data_preprocessing.php';
    include_once "config.php";
    include_once 'saloon_class.php';
    include_once 'appointment_class.php';
    class User
    {
        protected $uname;
        protected $pw;
        protected $name;
        protected $phoneno;
        
        public function __construct($uname_inp)
        {
            $this->uname = text_preprocessing(strtolower($uname_inp));
        }
        
        public function setpw($pw_new)
        {
            $this->pw = $pw_new;
        }

        public function setname($name_new)
        {
            $this->name = text_preprocessing($name_new);
        }
        public function setphoneno($phoneno_new)
        {
            $this->phoneno = text_preprocessing($phoneno_new);
        }

        public function setfromsql($result)
        {
            $this->uname = $result["User_ID"];
            $this->pw = $result["Pword"];
            $this->name = $result["Name"];
            $this->phoneno = $result["Phone_Number"];
        }

        public function is_user()
        {
            include "config.php";
            $sql = "SELECT * FROM users WHERE User_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                return True;
            }
            else{
                return False;
            }
            $conn->close();
        }

        public function addintodb()
        {
            include "config.php";
            if($this->is_user()==False)
            {
                $pw = password_hash($this->pw,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (User_ID,Pword,Name,Phone_Number) VALUES ('$this->uname','$pw','$this->name','$this->phoneno')";
                if ($conn->query($sql) === True)
                {
                    echo "New record created successfully";
                }
                else
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        }

        public function getfromdb()
        {
            include "config.php";
            $sql = "SELECT * FROM users WHERE User_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $this->name = $row["Name"];
                $this->phoneno = $row["Phone_Number"];
            }
            $conn->close();
        }

        public function updateintodb()
        {
            include "config.php";
            $pw = password_hash($this->pw,PASSWORD_DEFAULT);
            $sql = "UPDATE users SET User_ID = '$this->uname', Pword = '$pw', Name = '$this->name', Phone_Number = '$this->phoneno' WHERE User_ID='$this->uname'";
            if ($conn->query($sql) === True) {
                echo "Record Updated successfully";
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }

        public function get_name()
        {
            return $this->uname;
        }

        public function check_login()
        {
            include "config.php";
            $sql = "SELECT * FROM users WHERE User_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                $result = $result->fetch_assoc();
                $hash = $result["Pword"];
                if (password_verify($this->pw,$hash)){
                    return True;
                }
            }
            return False;
            $conn->close();
        }

        public function get_real_name()
        {
            return $this->name;
        }

    }
    
    class customer extends User
    {
        private $email;
        private $rating;

        function set_email($inp_email)
        {
            $this->email =  $inp_email;
        }

        function add_into_table()
        {
            include "config.php";
            $sql = "INSERT INTO customer (User_ID,email) VALUES ('$this->uname','$this->mail')";

            if ($conn->query($sql) === True) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }

        function is_customer()
        { 
            include "config.php";
            $sql = "SELECT * FROM customer WHERE User_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                return True;
            }
            else{
                return False;
            }
            $conn->close();
        }

        function get_rating()
        {
            include "config.php";
            $sql = "SELECT AVG(customer_rating) FROM appointment WHERE customer_ID='$this->uname'";
            $result = $conn->query($sql);
            $result=$result->fetch_assoc()["AVG(customer_rating)"];
            if (is_null($result))
            {
                $this->rating = 2.5;
            }
            else
            {
                $this->rating = $result;
            }
            return $this->rating;
        }

        function get_past_appointments_from_db_as_table()
        {
            echo "<table>
            <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Designer Name</th>
            <th>Saloon Name</th>
            <th>Saloon Phone Number</th>
            <th>Hair Cut</th>
            <th>Shave</th>
            <th>Massage</th>
            <th>Dye</th>
            <th>Rating</th>
            </tr>";            
            $sql = "SELECT * FROM appointment
            INNER JOIN users ON users.User_ID = appointment.employee_ID
            INNER JOIN employee ON appointment.employee_ID = employee.User_ID
            INNER JOIN saloon ON employee.Saloon_ID = saloon.Saloon_ID
            WHERE appointment.customer_ID='$this->uname' AND appointment.dop < CURRENT_DATE()
            ORDER BY appointment.dop";
            include "config.php";
            $result = $conn->query($sql);
            while ($appointment = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $appointment['dop'] . "</td>";
                echo "<td>" . $appointment['toa'] . "</td>";
                echo "<td>" . $appointment['Name'] . "</td>";
                echo "<td>" . $appointment['Saloon_Name'] . "</td>";
                echo "<td>" . $appointment['Phone_Number'] . "</td>";
                echo "<td>" . $appointment['hair_cut'] . "</td>";
                echo "<td>" . $appointment['shave'] . "</td>";
                echo "<td>" . $appointment['Massage'] . "</td>";
                echo "<td>" . $appointment['dye'] . "</td>";
                echo "<td>" . $appointment['employee_rating'] . "</td>";
                echo "<td><input type='radio' name='selected_appointment' value=" . $appointment['AppointmentID'] . "></input></td>";
                echo "</tr>";        
            }
            echo "</table>";    
        }

        function get_upcoming_appointments_from_db_as_table()
        {
            echo "<table>
            <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Designer Name</th>
            <th>Saloon Name</th>
            <th>Saloon Phone Number</th>
            <th>Hair Cut</th>
            <th>Shave</th>
            <th>Massage</th>
            <th>Dye</th>
            </tr>";            
            $sql = "SELECT appointment.dop, appointment.toa, appointment.hair_cut,users.name,appointment.shave,appointment.Massage,appointment.dye,saloon.Phone_Number, users.Name,saloon.Saloon_Name
            FROM appointment
            INNER JOIN users ON users.User_ID = appointment.employee_ID
            INNER JOIN employee ON appointment.employee_ID = employee.User_ID
            INNER JOIN saloon ON employee.Saloon_ID = saloon.Saloon_ID
            WHERE appointment.customer_ID='$this->uname'
            AND appointment.dop>=CURDATE()
            ORDER BY appointment.dop";
            include "config.php";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                while ($appointment = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $appointment['dop'] . "</td>";
                    echo "<td>" . $appointment['toa'] . "</td>";
                    echo "<td>" . $appointment['Name'] . "</td>";
                    echo "<td>" . $appointment['Saloon_Name'] . "</td>";
                    echo "<td>" . $appointment['Phone_Number'] . "</td>";
                    echo "<td>" . $appointment['hair_cut'] . "</td>";
                    echo "<td>" . $appointment['shave'] . "</td>";
                    echo "<td>" . $appointment['Massage'] . "</td>";
                    echo "<td>" . $appointment['dye'] . "</td>";
                    echo "</tr>";
                }            
            }
            echo "</table>";
        }
        
        
    }

    class employee extends User
    {
        private $salary;
        private $saloon;
        private $appointments;
        private $rating;

        public function set_salary($inp_salary)
        {
            $this->salary = $inp_salary;
        }

        public function set_saloon($inp_saloon)
        {
            $this->saloon = $inp_saloon;
        }

        public function add_into_table()
        {
            include "config.php";
            $saloon_ID = $this->saloon->getID();
            $sql = "INSERT INTO employee (User_ID,Salary,Saloon_ID) VALUES ('$this->uname','$this->salary','$saloon_ID')";

            if ($conn->query($sql) === True) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }

        public function is_employee()
        {
            include "config.php";
            $sql = "SELECT * FROM employee WHERE User_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                return True;
            }
            else{
                return False;
            }
            $conn->close();
        }

        public function get_table_data()
        {
            echo "<tr>";
            echo "<td>" . $this->name . "</td>";
            echo "<td>" . $this->saloon->getName() . "</td>";
            echo "<td>" . $this->phoneno . "</td>";
            echo "</tr>";
        }

        public function get_from_table()
        {
            include "config.php";
            $sql = "SELECT * FROM employee
            INNER JOIN saloon ON saloon.Saloon_ID =  employee.Saloon_ID
            WHERE employee.User_ID = '$this->uname'";
            $result = $conn->query($sql);
            $result = $result->fetch_assoc();
            $this->salary = $result["Salary"];
            $this->saloon = new saloon($result["Saloon_ID"]);
            $this->saloon->getfromdb();
            $conn->close();
        }

        public function update_table()
        {
            include "config.php";
            $sql = "UPDATE INTO employee SET (Salary) VALUES ('$this->salary') WHERE User_ID = '$this->uname'";
            if ($conn->query($sql) === True) {
                echo "Record Updated successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
        }

        public function get_saloon()
        {
            return $this->saloon;
        }

        public function add_appointment($appointment)
        {
            if(is_null($this->appointments))
            {
                $this->appointments = array();
            }
            array_push($this->appointments,$appointment);
        }

        public function set_appointments_from_db()
        {
            include "config.php";
            $sql = "SELECT * FROM appointment WHERE employee_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                while($row = $result->fetch_assoc())
                {
                    $appointment = new apoointment($row["AppointmentID"]);
                    $appointment->get_from_db();
                    $this->add_appointment($appointment);
                }
            }
            $conn->close();
        }

        public function get_appointments()
        {
            return $this->appointments;
        }

        function get_rating()
        {
            include "config.php";
            $sql = "SELECT AVG(employee_rating) FROM appointment WHERE employee_ID = '$this->uname'";
            $result = $conn->query($sql);
            $result=$result->fetch_assoc()["AVG(employee_rating)"];
            if (is_null($result))
            {
                $this->rating = 2.5;
            }
            else
            {
                $this->rating = $result;
            }
            return $this->rating;
        }

        function get_past_appointments_from_db_as_table()
        {
            include "config.php";
            echo "<table>
            <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Hair Cut</th>
            <th>Shave</th>
            <th>Massage</th>
            <th>Dye</th>
            <th>Rating</th>
            </tr>";            
            $sql = "SELECT * FROM appointment
            WHERE employee_ID='$this->uname' AND dop<CURRENT_DATE()
            ORDER BY appointment.dop";
            $result = $conn->query($sql);
            while ($appointment = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $appointment['dop'] . "</td>";
                echo "<td>" . $appointment['toa'] . "</td>";
                echo "<td>" . $appointment['hair_cut'] . "</td>";
                echo "<td>" . $appointment['shave'] . "</td>";
                echo "<td>" . $appointment['Massage'] . "</td>";
                echo "<td>" . $appointment['dye'] . "</td>";
                echo "<td>" . $appointment['customer_rating'] . "</td>";
                echo "<td><input type='radio' name='selected_appointment' value=" . $appointment['AppointmentID'] . "></input></td>";
                echo "</tr>";
            }
            echo"</table>";            
        }

        function get_upcoming_appointments_from_db_as_table()
        {
            echo "<table>
            <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Client's Name</th>
            <th>Client's Phone Number</th>
            <th>Hair Cut</th>
            <th>Shave</th>
            <th>Massage</th>
            <th>Dye</th>
            </tr>";            
            $sql = "SELECT appointment.dop, appointment.toa, appointment.hair_cut, appointment.shave,appointment.Massage,appointment.dye, users.Name,users.Phone_Number
            FROM appointment
            INNER JOIN users ON users.User_ID = appointment.customer_ID
            WHERE appointment.employee_ID='$this->uname'
            AND DATEDIFF(CONCAT(appointment.dop, ' ' ,appointment.toa),NOW())>0
            ORDER BY appointment.dop";
            include "config.php";
            $result = $conn->query($sql);
            while ($appointment = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $appointment['dop'] . "</td>";
                echo "<td>" . $appointment['toa'] . "</td>";
                echo "<td>" . $appointment['Name'] . "</td>";
                echo "<td>" . $appointment['Phone_Number'] . "</td>";
                echo "<td>" . $appointment['hair_cut'] . "</td>";
                echo "<td>" . $appointment['shave'] . "</td>";
                echo "<td>" . $appointment['Massage'] . "</td>";
                echo "<td>" . $appointment['dye'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";            
        }
        
    }
    
    class admin extends User
    {
        private $email;
        private $saloons;

        function set_email($inp_email)
        {
            $this->email =  $inp_email;
        }

        function add_into_table()
        {
            include "config.php";
            $sql = "INSERT INTO system_admins (User_ID,email) VALUES ('$this->uname','$this->email')";

            if ($conn->query($sql) === True) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }

        function is_admin()
        {
            
            include "config.php";
            $sql = "SELECT * FROM system_admins WHERE User_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                return True;
            }
            else{
                return False;
            }
            $conn->close();
        }

        function add_saloon($saloon)
        {
            if(is_null($this->saloons))
            {
                $this->saloons = array();
            }
            array_push($this->saloons,$saloon);
        }

        function add_saloons_from_db()
        {
            include "config.php";
            $sql = "SELECT * FROM saloon WHERE Agent_ID='$this->uname'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                while($row = $result->fetch_assoc())
                {
                    $saloon = new saloon($row["Saloon_ID"]);
                    $saloon->setname($row["Saloon_Name"]);
                    $saloon->setloc($row["Location"]);
                    $saloon->setagent_id($this->uname);
                    $saloon->setphoneno($row["Phone_Number"]);
                    $this->add_saloon($saloon);
                }
            }
            $conn->close();
        }

        function get_saloon_details_table()
        {
            foreach($this->saloons as $saloon)
            {
                echo "<tr>";
                echo "<td>" . $saloon->getName() . "</td>";
                echo "<td>" . $saloon->get_due() . "</td>";
                echo "<td><input type='radio' name='selected_saloon' value=" . $saloon->getID() . "></input></td>";
                echo "</tr>";
            }
            
        }   
    }
?>