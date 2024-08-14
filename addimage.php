<?php
// include 'connect.php';
session_start();

if(isset($_POST['ajouter'])){
    $description = $_POST['description']; // changed from 'description' to 'desc'
    $target_dir = "image/";
    $image = $target_dir . basename($_FILES['image']["name"]); // changed from 'ID' to 'name'

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        // Use prepared statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO stage (description, image) VALUES (?, ?)"); // removed extra '?'
        $stmt->bind_param("ss", $description, $image); // removed extra 's'

        if ($stmt->execute()) {
            echo "Formation ajoutée avec succès";
        } else {
            echo "Erreur lors de l'ajout de la formation : " . $conn->error;
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
        <form action="addimage.php.php" method="post" enctype="multipart/form-data" >
            <input type="text" name="description" placeholder="Description du produit"><br><br>
            <input type="file" name="image" placeholder="Image du produit"><br><br>
            <input type="submit" name="ajouter" value="Ajouter">
        </form>
        </div>
        </section>
</body>
</html>