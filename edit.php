<?php
require_once 'classes(OOP)/Database.php';
require_once 'classes(OOP)/User.php';

$db = new Database();
$pdo = $db->getConnection();
$user = new User($pdo);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid ID.");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $info = $_POST['some_information'] ?? '';
    $password = $_POST['password'];

    if ($user->validate($name, $email, $password)) {
        $user->update($id, $name, $email, $info, $password);
        header("Location: admin.php");
        exit();
    } else {
        echo "Invalid data!";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: #b6effb;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            min-width: 300px;
        }

        label {
            display: block;
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        h1 {
            text-align: center;
            margin-bottom: 60px;
        }
    </style>
</head>
<body>
<form method="post" >
    <h1>Edit</h1>
    <label>Name:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>">
    </label><br><br>

    <label>Email:<br>
        <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>">
    </label><br><br>

    <label>Information:<br>
        <textarea name="some_information"><?= htmlspecialchars($row['some_information']) ?></textarea>
    </label><br><br>

    <button type="submit">Update</button>
</form>
</body>
</html>