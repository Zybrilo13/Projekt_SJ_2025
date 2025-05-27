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

    public function update($id, $name, $email, $message)
        {
            $sql = "UPDATE users SET name = ?, email = ?, some_information = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $email, $message, $id]);

    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

}

