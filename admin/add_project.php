<?php
require_once('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $random = rand(10000, 99999);
    $newname = 'image' . $random;

    $filetype = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));

    if ($filetype == 'jpeg') {
        $filetype = 'jpg';
    }
    $allowed_types = ['jpg', 'png', 'gif'];
    if (!in_array($filetype, $allowed_types)) {
        die('<div class="alert alert-danger">Sorry, only JPG, PNG, and GIF files are allowed.</div>');
    }

    if ($_FILES['img']['size'] > 500000) {
        die('<div class="alert alert-danger">Sorry, your file is too large.</div>');
    }

    $newname .= '.' . $filetype;
    $target_file = '../images/' . $newname;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        $query = "INSERT INTO projects (name, image, description, challenges, solution) VALUES (?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($query);

        $title = trim($_POST['title']);
        $desc = trim($_POST['desc']);
        $image = $newname;

        $challenges = trim($_POST['challenges']);
        $solution = trim($_POST['solution']);

        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $image, PDO::PARAM_STR);
        $stmt->bindParam(3, $desc, PDO::PARAM_STR);
        $stmt->bindParam(4, $challeges, PDO::PARAM_STR);
        $stmt->bindParam(5, $solution, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $lastid = $connection->lastInsertId();
            echo '<div class="alert alert-success">Project added successfully! Project ID: ' . $lastid . '</div>';
            header('Refresh: 1; URL=project_list.php');
            exit();
        } catch (PDOException $e) {
            die('<div class="alert alert-danger">Database error: ' . $e->getMessage() . '</div>');
        }
        $stmt = null;
    } else {
        die('<div class="alert alert-danger">Failed to upload file. Check directory permissions.</div>');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Add New Project</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Project Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea name="desc" id="desc" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="challenges" class="form-label">Challenges</label>
            <textarea name="challenges" id="challenges" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="solution" class="form-label">Solution</label>
            <textarea name="solution" id="solution" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Upload Image</label>
            <input type="file" name="img" id="img" class="form-control" accept=".jpg, .png, .gif" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Project</button>
    </form>
</div>

</body>
</html>