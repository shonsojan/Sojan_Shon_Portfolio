<?php
require_once('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate a unique, web-safe name for the image
    $random = rand(10000, 99999);
    $newname = 'image' . $random;

    // Get the file extension
    $filetype = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));

    // Normalize and validate file type
    if ($filetype == 'jpeg') {
        $filetype = 'jpg';
    }
    $allowed_types = ['jpg', 'png', 'gif'];
    if (!in_array($filetype, $allowed_types)) {
        die('Sorry, only JPG, PNG, and GIF files are allowed.');
    }

    // Check file size (500KB limit)
    if ($_FILES['img']['size'] > 500000) {
        die('Sorry, your file is too large.');
    }

    // Append the extension
    $newname .= '.' . $filetype;
    $target_file = '../images/' . $newname;

    // Move the file and insert into the database
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        // PDO database insert with all required columns
        $query = "INSERT INTO projects (name, image, description, challeges, solution) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        // Form data
        $title = trim($_POST['title']);
        $desc = trim($_POST['desc']);
        $image = $newname;

        // Placeholder values for challeges and solution (update form to collect these later)
        $challeges = "To be updated"; // Temporary placeholder
        $solution = "To be updated";  // Temporary placeholder

        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $image, PDO::PARAM_STR);
        $stmt->bindParam(3, $desc, PDO::PARAM_STR);
        $stmt->bindParam(4, $challeges, PDO::PARAM_STR);
        $stmt->bindParam(5, $solution, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $lastid = $connection->lastInsertId();
            echo "Project added with ID: " . $lastid; // Optional: for debugging
            header('Location: project_list.php');
            exit();
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }

        $stmt = null;
    } else {
        // Check why the upload failed
        if (!isset($_FILES['img']) || $_FILES['img']['error'] == UPLOAD_ERR_NO_FILE) {
            die("No file was uploaded.");
        } elseif ($_FILES['img']['error'] != UPLOAD_ERR_OK) {
            die("Upload error: " . $_FILES['img']['error']);
        } else {
            die("Failed to move uploaded file. Check directory permissions for '../images/'.");
        }
    }
} else {
    die("Invalid request method.");
}
?>