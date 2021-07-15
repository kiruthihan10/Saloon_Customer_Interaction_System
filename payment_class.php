<?php
    include_once "saloon_class.php";
    class payment
    {
        private $saloon;
        private $cash;
        private $date;
        private $id;

        public function __construct($id)
        {
            $this->id = $id;
        }

        public function setsaloon($saloon)
        {
            $this->saloon = new saloon($saloon);
        }

        public function setdate($date)
        {
            $this->date = $date;
        }

        public function setcash($cash)
        {
            $this->cash = $cash;
        }

        public function get_from_db()
        {
            include "config.php";
            include "saloon_class.php";
            $sql = "SELECT * FROM payments WHERE Payment_ID='$this->id'";
            $result = $conn->query($sql);
            if ($result->num_rows>0){
                $result = $result->fetch_assoc();
                $this->saloon=$result["Location"];
                $this->cash=new admin($result["Agent_ID"]);
                $this->date=$result["Phone_Number"];
            }
        }

        public function getcash()
        {
            return $this->cash;
        }

        public function addintodb()
        {
            include "config.php";
            $saloon_Id = $this->saloon->getID();
            $sql = "INSERT INTO payments (Saloon_ID,Price,Date_of_deposit) VALUES ('$saloon_Id','$this->cash','$this->date')";
            if ($conn->query($sql) === True)
            {
                $this->id = $conn->insert_id;
                echo "New record created successfully";
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }            
        }
    } 
?>