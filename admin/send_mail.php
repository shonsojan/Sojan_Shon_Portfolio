<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once('../includes/connect.php'); 

$errors = array();

$first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
if (empty($first_name)) {
    $errors[] = "First name field is empty.";
}

$last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
if (empty($last_name)) {
    $errors[] = "Last name field is empty.";
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if (empty($email)) {
    $errors[] = "Email field is empty.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "\"" . $email . "\" is not a valid email address.";
}

$message = isset($_POST['message']) ? trim($_POST['message']) : '';
if (empty($message)) {
    $errors[] = "Message field is empty.";
}

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
    exit();
}

try {
    $querystring = "INSERT INTO contacts (first_name, last_name, email, message) VALUES (:first_name, :last_name, :email, :message)";
    $stmt = $connection->prepare($querystring);

    $executed = $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':email' => $email,
        ':message' => $message
    ]);

    if ($executed) {
        echo json_encode(["message" => "Form submitted. Thank you for your interest!"]);
    } else {
        echo json_encode(["errors" => ["Database error: " . implode(" ", $stmt->errorInfo())]]);
    }
} catch (PDOException $e) {
    echo json_encode(["errors" => ["SQL error: " . $e->getMessage()]]);
}
?>