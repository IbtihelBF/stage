<?php
include 'connect.php';
session_start();
session_regenerate_id(true);

if (isset($_POST['ajouter'])) {
    $description = $_POST['description'];
    $target_dir = "image/";
    $image = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image réelle ou fausse
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("Le fichier n'est pas une image.");
    }

    // Vérifier la taille du fichier
    if ($_FILES["image"]["size"] > 5000000) { // Limite de 5 Mo
        die("Désolé, votre fichier est trop volumineux.");
    }

    // Autoriser certains formats de fichiers
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedFormats)) {
        die("Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
    }

    // Déplacement du fichier vers le répertoire de destination
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        // Sauvegarde seulement le chemin relatif dans la base de données
        $imageRelativePath = $target_dir . basename($_FILES['image']['name']);
        $stmt = $connect->prepare("INSERT INTO produit (description, image_path) VALUES (?, ?)");
    
        // Vérifiez si la requête a été préparée avec succès
        if ($stmt === false) {
            die("Erreur lors de la préparation de la requête : " . $connect->error);
        }
    
        if (!$stmt->bind_param("ss", $description, $imageRelativePath)) {
            die("Erreur lors du binding des paramètres : " . $stmt->error);
        }
    
        if ($stmt->execute()) {
            // Redirection vers index.php après l'ajout réussi
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'image : " . $stmt->error;
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
    <title>Ajouter une Image</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #141E30, #243B55);
            color: #fff;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        h1 {
            font-family: 'Pacifico', cursive;
            margin-bottom: 1rem;
            color: #48cae4;
        }
        input[type="text"], input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border: none;
            border-radius: 5px;
            outline: none;
        }
        input[type="text"], input[type="file"] {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        input[type="submit"] {
            background-color: #48cae4;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0096c7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter une Image</h1>
        <form action="addimage.php" method="post" enctype="multipart/form-data">
            <input type="text" name="description" placeholder="Description de l'image" required><br>
            <input type="file" name="image" required><br>
            <input type="submit" name="ajouter" value="Ajouter l'image">
        </form>
    </div>
</body>
</html>
