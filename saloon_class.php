<?php
    include_once 'user_class.php';
    include_once 'data_preprocessing.php';
    include_once "config.php";
    include_once "payment_class.php";
    class saloon
    {
        private $id;
        private $name;
        private $location;
        private $phoneno;
        private $agent;
        private $employees;
        private $payments;

        public function __construct($id){
            $this->id = $id;
            $this->employees = array();
            $this->payments = array();
        }

        public function reset_payments()
        {
            $this->payment = array();
        }

        public function setname($name)
        {
            $this->name=$name;
        }

        public function setloc($loc_new)
        {
            $this->location = text_preprocessing($loc_new);
        }

        public function setagent_id($agent_new)
        {
            $this->agent = new Admin($agent_new);
        }

        public function setphoneno($phoneno_new)
        {
            $this->phoneno = text_preprocessing($phoneno_new);
        }

        public function add_employee($employee)
        {
            array_push($this->employees,$employee);
        }

        public function get_employees()
        {
            return $this->employees;
        }

        public function getloc()
        {
            return $this->location;
        }

        public function getagent()
        {
            return $this->agent;
        }
        public function getphoneno()
        {
            return $this->phoneno;
        }

        public function addintodb()
        {
            include "config.php";
            $agent_id = $this->agent->get_name();
            $sql = "INSERT INTO saloon (Saloon_Name,Location,Phone_Number,Agent_ID) VALUES ('$this->name','$this->location','$this->phoneno','$agent_id')";

            if ($conn->query($sql) === TRUE) {
                $this->id = $conn->insert_id;
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }

        public function getfromdb()
        {
            include "config.php";
            $sql = "SELECT * FROM saloon WHERE Saloon_ID = '$this->id'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                $result = $result->fetch_assoc();
                $this->name=$result["Saloon_Name"];
                $this->location=$result["Location"];
                $this->agent=new admin($result["Agent_ID"]);
                $this->phoneno=$result["Phone_Number"];
            }
            $conn->close();
        }

        public function getName()
        {
            return $this->name;
        }

        public function getID()
        {
            return $this->id;
        }

        public function get_employees_from_db()
        {
            include("config.php");
            $sql = "SELECT * FROM employee WHERE Saloon_ID='$this->id'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                while($row = $result->fetch_assoc())
                {
                    $employee = new employee($row["User_ID"]);
                    $employee->getfromdb();
                    $employee->get_from_table();
                    $this->add_employee($employee);
                }
            }
            $conn->close();
        }

        public function add_payment($payment)
        {
            if(is_null($this->payments))
            {
                $this->payments = array();
            }
            array_push($this->payments,$payment);
        }

        public function get_payemts_from_db()
        {
            include "config.php";
            $sql = "SELECT * FROM payments WHERE Saloon_ID = '$this->id'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                while($row = $result->fetch_assoc())
                {
                    $payment = new payment($row["Payment_ID"]);
                    $payment->setsaloon($this->id);
                    $payment->setdate($row["Date_of_deposit"]);
                    $payment->setcash($row["Price"]);
                    $this->add_payment($payment);
                }
            }
            $conn->close();
        }

        public function get_due()
        {
            $this->get_employees_from_db();
            $due = 0;
            foreach($this->employees as $employee)
            {
                $employee->set_appointments_from_db();
                if (is_null($employee->get_appointments()))
                {
                    null;   
                }
                else
                {
                    foreach($employee->get_appointments() as $appointment)
                    {
                        if ($appointment->get_customer_rating()!=0)
                        {
                            $due += $appointment->get_cost();
                        }
                    }
                }
                
            }
            $this->reset_payments();
            $this->get_payemts_from_db();
            foreach($this->payments as $payment)
            {
                $due-=$payment->getcash();
            }
            return $due;
        }

        

    }
?>