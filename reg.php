<?php
    $name = trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $message = trim($_POST["message"]);

    if(strlen($email) < 2){
        echo "invalid email";
    }

    if(strlen($name) < 2){
        echo "invalid name";
    }

    $pdo = new PDO('mysql:host=localhost;dbname=php_website', 'root', '');
    $sql = "INSERT INTO users(name, email, some_information) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $message]);

    header("Location: index.php");

