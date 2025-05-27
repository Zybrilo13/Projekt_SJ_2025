<?php
class User {
    private $pdo;

    public function __construct($dbConnection) {
        $this->pdo = $dbConnection;
    }

    public function validate($name, $email, $password) {
        return strlen($name) >= 2 && strlen($email) >= 2 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 8;
    }

    public function save($name, $email, $message, $password) {
        $sql = "INSERT INTO users(name, email, some_information, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$name, $email, $message, $hashedPassword]);

    }

    public function update($id, $name, $email, $message, $password)
    {
        $sql = "UPDATE users SET name = ?, email = ?, some_information = ?, password = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $email, $message, $password, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

}

