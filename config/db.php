<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'crud_system';
    private $username = 'root';
    private $password = '';
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
