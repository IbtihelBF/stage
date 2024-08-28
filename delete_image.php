<?php
<<<<<<< HEAD
include 'connect.php';

if (isset($_GET['image_path'])) {
    $imagePath = urldecode($_GET['image_path']);  // Decode the image path

    // Fetch the record from the database based on the image path
    $stmt = $connect->prepare("SELECT ID FROM produit WHERE image_path = ?");
    $stmt->bind_param("s", $imagePath);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    // Delete the record from the database only
    $stmt = $connect->prepare("DELETE FROM produit WHERE image_path = ?");
    $stmt->bind_param("s", $imagePath);

    if ($stmt->execute()) {
        // Redirect after successful deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting the image record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Image path not specified.";
}
=======
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
>>>>>>> d231883071f80c961e4deeca0547db29e21eb0a2
?>
