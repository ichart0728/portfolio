<?php

    class Database{
        private $servername = "localhost";
        private $username = "root";
        private $password = "root";
        private $database = "portfolio";
        public $conn;

        //Constructor
        public function __construct(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
                if($this->conn->connect_error){
                    die("Connection error: " .$this->conn->coonect_error);                                                    
                }

                return $this->conn;
        }
    }
    
?>