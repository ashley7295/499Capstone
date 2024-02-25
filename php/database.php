<?php
class Database {
  private $host = "127.0.0.1";
  private $username = "root";
  private $password = "";
  private $database = "Voting";
  private $conn;

  public function __construct($host, $username, $password, $database) {
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;

    $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function execute($query) {
    $result = $this->conn->query($query);

    if (!$result) {
      die("Query failed: " . $this->conn->error);
    }

    return $result;
  }

  public function __destruct() {
    $this->conn->close();
  }
}