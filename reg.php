<?php
require_once 'classes(OOP)/Database.php';
require_once 'classes(OOP)/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $message = trim($_POST["message"]);

    $db = new Database();
    $pdo = $db->getConnection();
    $user = new User($pdo);

    if ($user->validate($name, $email)) {
        $user->save($name, $email, $message);
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid input data.";
    }
}
?>