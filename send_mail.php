<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $db_host = 'localhost:8889';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'portfolio';

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $errors = array();

    $lname = mysqli_real_escape_string($connection, $_POST['last_name']);
    if ($lname == NULL) {
        $errors[] = "Last name field is empty.";
    }

    $fname = mysqli_real_escape_string($connection, $_POST['first_name']);
    if ($fname == NULL) {
        $errors[] = "First name field is empty.";
    }

    $message = mysqli_real_escape_string($connection, $_POST['message']);
    if ($message == NULL) {
        $errors[] = "message field is empty.";
    }

    $email = $_POST['email'];
    if ($email == NULL) {
        $errors[] = "Email field is empty.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "\"" . $email . "\" is not a valid email address.";
    }

    $errcount = count($errors);
    if ($errcount > 0) {
        $errmsg = array();
        for ($i = 0; $i < $errcount; $i++) {
            $errmsg[] = $errors[$i];
        }
        echo json_encode(array("errors" => $errmsg));
    } else {
        $querystring = "INSERT INTO enquiries(id,last_name,first_name,email,message) VALUES(NULL,'" . $lname . "','" . $fname . "','" . $message . "','" . $email . "')";
        $qpartner = mysqli_query($connection, $querystring);
        echo json_encode(array("message" => "Form submitted. Thank you for your interest!"));
    }
?>