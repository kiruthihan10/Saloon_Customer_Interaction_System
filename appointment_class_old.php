<?php
    class apoointment
    {
        private $customer;
        private $employee;
        private $Dye;
        private $Massage;
        private $Shave;
        private $Hair_Cut;
        private $Date;
        private $Time;

        public function __construct($uid)
        {
            include "user_class.php";
            $user = new customer($uid);
            if ($user->is_customer())
            {
                $this->customer = $user;
            }
            else
            {
                $user = new employee($uid);
                if ($user->is_employee())
                {
                    $this->employee=$user;
                }
            }
        }

        public function set_customer($uid)
        {
            include "user_class.php";
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
            include 'config.php';
            $sql = "INSERT INTO appointment (customer_ID,dop,dye,employee_ID,hair_cut,Massage,shave,toa) VALUES ('$this->customer_ID','$this->Date','$this->Dye','$this->employee_ID','$this->Hair_Cut','$this->Massage','$this->Shave','$this->Time')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        public function get_from_db()
        {
            include "user_class.php";
            include "config.php";
            if(is_null($employee)==False)
            {
                $sql = "SELECT * FROM appointment WHERE employee_ID = '$this->employee'";
            }
            else if(is_null($customer)==False)
            {
                $sql = "SELECT * FROM appointment WHERE customer_ID = '$this->customer'";
            }
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                $result = $result->fetch_assoc();
                $this-> $setcustomer($result["customer_ID"]);
                $this-> $setemployee($result["employee_ID"]);
                $this-> $setdye($result["dye"]);
                $this-> $setMassage($result["Massage"]);
                $this-> $setShave($result["Massage"]);
                $this-> $setHair_Cut($result["hair_cut"]);
                $this-> $setDate($result["dop"]);
                $this-> $setTime($result["toa"]);
            }
            $conn->close();
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

    }
?>