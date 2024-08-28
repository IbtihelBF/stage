<?php
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
?>
