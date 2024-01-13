<?php

    class DatabaseHelper{
        private $db;

        public function __construct() {
            $servername = "localhost";
            $username = "root";
            $password = "";
    
            // Creating connection
            $this->db = new mysqli($servername, $username, $password);
    
            // Checking connection
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
    
            // Reading the SQL file content
            $sqlFile = file_get_contents('db_creation.sql');
    
            // Executing the SQL file
            if (!$this->db->multi_query($sqlFile)) {
                die("Error creating tables: " . $this->db->error . "\n");
            }
        }

    }
