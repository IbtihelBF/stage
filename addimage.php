<?php
include 'connect.php';
session_start();

if (isset($_POST['ajouter'])) {
    $description = $_POST['description'];
    $target_dir = "image/";
    $image = $target_dir . basename($_FILES['image']["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        // Use prepared statement to avoid SQL injection
        $stmt = $connect->prepare("INSERT INTO produit (description, image) VALUES (?, ?)");
        
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Error preparing the statement: " . $connect->error);
        }

        $stmt->bind_param("ss", $description, $image);

        if ($stmt->execute()) {
            echo "Produit ajoutée avec succès";
        } else {
            echo "Erreur lors de l'ajout du produit : " . $stmt->error;
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
    <title>Ajouter un produit</title>
</head>

<body>
<section class="joinus">
        <div class="joinus-heading">
        <h1>Ajouter un produit</h1>
        <form action="addimage.php" method="post" enctype="multipart/form-data">
            <input type="text" name="description" placeholder="Description du produit"><br><br>
            <input type="file" name="image" placeholder="Image du produit"><br><br>
            <input type="submit" name="ajouter" value="Ajouter">
        </form>
        </div>
</section>
</body>
</html>
