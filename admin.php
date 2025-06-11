<?php
require_once 'classes(OOP)/Database.php';
require_once 'classes(OOP)/User.php';

$db = new Database();
$pdo = $db->getConnection();
$user = new User($pdo);


if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $user->delete($id);
    header("Location: admin.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <style>
        h1 {text-align: center}
        table { border-collapse: inherit; width: 80%; margin: auto}
        th, td { border: 1px solid black; padding: 4px; text-align: center; }
        th { background-color: white; }
        a.button { padding: 2px 7px; background-color: blueviolet; color: white; text-decoration: none; border-radius: 3px; }
        a.button.delete { background-color: red; }
        .center-btn {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .home-button {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .home-button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
<h1>Admin panel</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Some information</th>
        <th>actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['some_information']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="button">edit</a>
                <a href="admin.php?delete=<?= $row['id'] ?>" class="button delete">delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="center-btn">
    <a href="index.php" class="home-button">Back</a>
</div>
</body>
</html>

