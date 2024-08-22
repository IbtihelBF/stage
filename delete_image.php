<?php
// include 'connect.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     // Récupération de l'image à supprimer
//     $stmt = $connect->prepare("SELECT image FROM produit WHERE ID = ?");
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $stmt->bind_result($imagePath);
//     $stmt->fetch();
//     $stmt->close();

//     // Suppression du fichier image du système de fichiers
//     if (file_exists($imagePath)) {
//         unlink($imagePath);
//     }

//     // Suppression de l'enregistrement de la base de données
//     $stmt = $connect->prepare("DELETE FROM produit WHERE ID = ?");
//     $stmt->bind_param("i", $id);
//     if ($stmt->execute()) {
//         // Redirection après suppression
//         header("Location: index.php");
//         exit();
//     } else {
//         echo "Erreur lors de la suppression de l'image : " . $stmt->error;
//     }
//     $stmt->close();
// } else {
//     echo "ID non spécifié.";
// }
    include 'connect.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Suppression de l'enregistrement de la base de données
        $stmt = $connect->prepare("DELETE FROM produit WHERE ID = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirection après suppression
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de la suppression de l'image : " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID non spécifié.";
    }
?>
