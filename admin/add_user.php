<?php
require_once('../includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $stmt = $connection->prepare("INSERT INTO user (username, email, full_name, password, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$_POST['username'], $_POST['email'], $_POST['full_name'], $hashedPassword, $_POST['role'], $_POST['status']]);

    echo "User added successfully!";
}
?>

