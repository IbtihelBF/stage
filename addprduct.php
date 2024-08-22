<?php
include 'connexion.php';
session_start();

if(isset($_POST['ajouter'])){
    $description = $_POST['description'];
    $target_dir = "image/";
    $image = $target_dir . basename($_FILES['image']["ID"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        // Use prepared statement to avoid SQL injection
        $stmt = $connexion->prepare("INSERT INTO formations ( description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $description, $image);

        if ($stmt->execute()) {
            echo "Formation ajoutée avec succès";
        } else {
            echo "Erreur lors de l'ajout de la formation : " . $connexion->error;
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
    <title>Add Product</title>
</head>

<body>
<section class="joinus">
        <div class="joinus-heading">
        <h1>Ajouter une formation</h1>
        <form action="createformation.php" method="post" enctype="multipart/form-data" >
            <input type="text" name="desc" placeholder="Description de la formation"><br><br>
            <input type="file" name="image" placeholder="Image de la formation"><br><br>
            <input type="submit" name="ajouter" value="Ajouter">
        </form>
        </div>
        </section>
</body>
</html>
