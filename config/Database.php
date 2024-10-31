<?php
/**
 * Class Database
 * Menangani koneksi database menggunakan PDO
 * 
 * Properties:
 * - $host: hostname database
 * - $db_name: nama database
 * - $username: username database
 * - $password: password database
 * - $conn: object koneksi PDO
 * 
 * Methods:
 * - getConnection(): Membuat dan mengembalikan koneksi PDO
 */

class Database {
    private $host = "localhost";
    private $db_name = "rental_mobil";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
