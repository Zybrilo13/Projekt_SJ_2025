<?php
class User {
    private $pdo;

    public function __construct($dbConnection) {
        $this->pdo = $dbConnection;
    }

    public function validate($name, $email) {
        return strlen($name) >= 2 && strlen($email) >= 2 && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function save($name, $email, $message) {
        $sql = "INSERT INTO users(name, email, some_information) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $email, $message]);
    }
}
