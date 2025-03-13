<?php
require_once('../includes/connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $stmt = $connection->prepare("INSERT INTO contacts (first_name, last_name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'],  $_POST['message']]);

    echo "Contact Registered successfully!";
    header('Refresh: 1; URL=../index.php');
}
?>

