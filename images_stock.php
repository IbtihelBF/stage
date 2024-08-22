<?php
include 'connect.php'; // Connexion à la base de données
session_start();

// Ajout de l'image dans la base de données
if (isset($_POST['ajouter'])) {
    $description = $_POST['desc'];
    $image = file_get_contents($_FILES['image']['tmp_name']); // Lire le contenu de l'image

    // Préparer la requête SQL
    $stmt = $conn->prepare("INSERT INTO image (description, image) VALUES (?, ?)");
    $stmt->bind_param("ss", $description, $image);

    if ($stmt->execute()) {
        echo "Image ajoutée avec succès";
    } else {
        echo "Erreur lors de l'ajout de l'image : " . $conn->error;
    }
    $stmt->close();
}
?>

<form action="images_stock.php" method="post" enctype="multipart/form-data">
    Description: <input type="text" name="desc" required><br>
    Image: <input type="file" name="image" required><br>
    <input type="submit" name="ajouter" value="Ajouter l'image">
</form>
