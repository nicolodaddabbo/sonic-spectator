<?php

class DatabaseConnection
{
    private $db;

    public function __construct()
    {
        // Creating connection
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS);

        // Checking connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        // Reading the SQL file content
        $sqlFile = file_get_contents(__DIR__ . '/db_creation.sql');

        // Executing the SQL file
        if (!$this->db->multi_query($sqlFile)) {
            die("Error creating tables: " . $this->db->error . "\n");
        }

        // Move to the next result set (to clear any remaining results)
        while ($this->db->more_results()) {
            $this->db->next_result();
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}

$dbh = new DatabaseConnection();
