<?php
require_once('../includes/connect.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectId = isset($_POST['pk']) ? intval($_POST['pk']) : 0;
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['desc']) ? trim($_POST['desc']) : '';
    $challenges = isset($_POST['challenges']) ? trim($_POST['challenges']) : '';
    $solution = isset($_POST['solution']) ? trim($_POST['solution']) : '';

    if (empty($title) || empty($description)) {
        die('<div class="container mt-5 text-danger">Title and description are required.</div>');
    }

    $stmt = $connection->prepare("SELECT image FROM projects WHERE id = ?");
    $stmt->execute([$projectId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = $row ? $row['image'] : ''; 

    if (!empty($_FILES['thumb']['name'])) {
        $targetDir = "../images/";
        $imageFileType = strtolower(pathinfo($_FILES['thumb']['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid("project_") . "." . $imageFileType;
        $targetFilePath = $targetDir . $newFileName;

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowedTypes)) {
            die('<div class="container mt-5 text-danger">Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.</div>');
        }

        if (getimagesize($_FILES['thumb']['tmp_name']) === false) {
            die('<div class="container mt-5 text-danger">File is not a valid image.</div>');
        }

        if (move_uploaded_file($_FILES['thumb']['tmp_name'], $targetFilePath)) {
            $image = $newFileName;
        } else {
            die('<div class="container mt-5 text-danger">Error uploading image.</div>');
        }
    }

    $query = 'UPDATE projects 
              SET name = :title, 
                  description = :description, 
                  image = :image, 
                  challenges = :challenges, 
                  solution = :solution, 
                  updated_at = NOW() 
              WHERE id = :projectId';
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':challenges', $challenges, PDO::PARAM_STR);
    $stmt->bindParam(':solution', $solution, PDO::PARAM_STR);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR);
    $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo '<div class="container mt-5 text-success">Project updated successfully!</div>';
        header('Location: project_list.php'); 
        exit();
    } else {
        die('<div class="container mt-5 text-danger">Error updating project.</div>');
    }
}
?>
