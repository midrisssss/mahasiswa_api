<?php
class Connection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_uag";
    public $conn;
    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}
?>