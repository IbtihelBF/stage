<?php
include 'connect.php'; // Include the database connection file
session_start();

if (isset($_POST['ajouter'])) {
    $id = $_POST['id'];
    $description = $_POST['desc'];
    $target_dir = "image/";
    $image_path = $target_dir . basename($_FILES['image']['name']); // Save the image path

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO image (ID, description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id, $description, $image_path);

        if ($stmt->execute()) {
            echo "Image ajoutée avec succès";
        } else {
            echo "Erreur lors de l'ajout de l'image : " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Image</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://example.com/background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 2rem;
            border-radius: 8px;
            width: 400px;
        }
        h1 {
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 24px;
            color: #fff;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background-color: #0066FF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Ajouter une image</h1>
        <form action="add_image.php" method="post" enctype="multipart/form-data">
            <input type="text" name="id" placeholder="ID" required><br>
            <input type="text" name="desc" placeholder="Description de l'image" required><br>
            <input type="file" name="image" required><br>
            <input type="submit" name="ajouter" value="Ajouter">
        </form>
    </div>
</body>
</html>
