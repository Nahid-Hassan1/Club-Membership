<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Database {
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "mydb";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerClient($name, $password, $number, $clubs, $membership, $feedback) {
        $clubString = implode(", ", $clubs);
        $sql = "INSERT INTO clientdata (name, password, number, clubs, membership, feedback)
                VALUES ('$name', '$password', '$number', '$clubString', '$membership', '$feedback')";
        $this->conn->query($sql);
    }

    public function loginClient($name, $password) {
        $sql = "SELECT * FROM clientdata WHERE name='$name' AND password='$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['client_id'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    public function getClientDetails() {
        $id = $_SESSION['client_id'];
        $sql = "SELECT * FROM clientdata WHERE id='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

   public function updateClientInfo($number, $clubs, $membership) {
    $id = $_SESSION['client_id'];
    $clubString = implode(", ", $clubs);
    $sql = "UPDATE clientdata SET number='$number', clubs='$clubString', membership='$membership' WHERE id='$id'";
    $this->conn->query($sql);
}


    public function deleteClient() {
        $id = $_SESSION['client_id'];
        $sql = "DELETE FROM clientdata WHERE id='$id'";
        $this->conn->query($sql);
        session_destroy();
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
