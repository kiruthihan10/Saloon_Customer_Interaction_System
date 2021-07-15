<?php
    include_once "user_class.php";
    include_once 'config.php';
    class apoointment
    {
        private $appointment_ID;
        private $customer;
        private $employee;
        private $Dye;
        private $Massage;
        private $Shave;
        private $Hair_Cut;
        private $Date;
        private $Time;
        private $customer_rating;
        private $employee_rating;

        public function __construct($app_id)
        {
            $this->appointment_ID = $app_id;
        }

        public function set_customer($uid)
        {
            $user = new customer($uid);
            if ($user->is_customer())
            {
                $this->customer = $user;
            }
            else
            {
                return -1;
            }
        }

        public function set_employee($uid)
        {
            $user = new employee($uid);
            if ($user->is_employee())
            {
                $this->employee=$user;
            }
            else
            {
                return -1;    
            }
        }

        public function setMassage($Massage)
        {
            $this->Massage = $Massage;
        }

        public function setdye($dye)
        {
            $this->Dye = $dye;
        }

        public function setHair_Cut($Hair_Cut)
        {
            $this->Hair_Cut = $Hair_Cut;
        }

        public function setShave($Shave)
        {
            $this->Shave = $Shave;
        }

        public function setDate($Date)
        {
            $this->Date = $Date;
        }

        public function setTime($Time)
        {
            $this->Time = $Time;
        }

        public function addintodb()
        {
            include "config.php";
            $customer_name = $this->customer->get_name();
            $employee_name = $this->employee->get_name();
            $sql = "INSERT INTO appointment (customer_ID,dop,dye,employee_ID,hair_cut,Massage,shave,toa) VALUES ('$customer_name','$this->Date','$this->Dye','$employee_name','$this->Hair_Cut','$this->Massage','$this->Shave','$this->Time')";
            if ($conn->query($sql) === TRUE) {
                $this->appointment_ID = $conn->insert_id;
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        public function get_from_db()
        {
            include "config.php";
            $sql  = "SELECT * FROM appointment WHERE AppointmentID = '$this->appointment_ID'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                $result = $result->fetch_assoc();
                $this-> set_customer($result["customer_ID"]);
                $this-> set_employee($result["employee_ID"]);
                $this-> setdye($result["dye"]);
                $this-> setMassage($result["Massage"]);
                $this-> setShave($result["Massage"]);
                $this-> setHair_Cut($result["hair_cut"]);
                $this-> setDate($result["dop"]);
                $this-> setTime($result["toa"]);
                $this-> customer_rating = $result["customer_rating"];
                $this-> employee_rating = $result["employee_rating"];
            }
            $conn->close();
        }

        public function get_customer_rating()
        {
            $this->customer_rating;
        }

        public function get_cost()
        {
            $share = 0.1;
            $cost = 0;
            if ($this->Hair_Cut)
            {
                $cost+=150;
            }
            if($this->Shave)
            {
                $cost+=100;
            }
            if($this->Massage)
            {
                $cost+=75;
            }
            if($this->Dye)
            {
                $cost+=200;
            }
            $cost*=$share;
            return $cost;
        }

        public function data_in_table_row_customer_view()
        {
            echo "<tr>";
            echo "<td>" . $this->date . "</td>";
            echo "<td>" . $this->time . "</td>";
            echo "<td>" . $this->employee->get_real_name() . "</td>";
            echo "<td>" . $this->employee->get_saloon()->getName() . "</td>";
            echo "<td>" . $this->employee->get_saloon()->getphoneno() . "</td>";
            echo "<td>" . $this->Hair_Cut . "</td>";
            echo "<td>" . $this->Shave . "</td>";
            echo "<td>" . $this->Massage . "</td>";
            echo "<td>" . $this->Dye . "</td>";
            echo "<td><input type='radio' name='selected_appointment' value=" . $this->appointment_ID . "></input></td>";
            echo "</tr>";
        }

        
        
    }
?>