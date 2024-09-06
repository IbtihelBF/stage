<?php
require_once 'connect.php';
/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];
/* Choose where to save the uploaded file */
$location = "image/".$filename;

/* Save the uploaded file to the local filesystem */
if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
    $images="";
    $stmt = $connect->prepare("INSERT INTO produit (description, image_path,image_name) VALUES (?, ?,?)");
        
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Erreur lors de la préparation de la requête : " . $connect->error);
    }

    // Bind parameters and execute the statement
    if (!$stmt->bind_param("sss", $filename, $location,$filename)) {
        die("Erreur lors du binding des paramètres : " . $stmt->error);
    }

    if ($stmt->execute()) {
        // Redirect to index.php after successful insertion
        $output = exec("py -X utf8 lens.py ". $filename ." upload");
    } else {
        echo "Erreur lors de l'ajout de l'image : " . $stmt->error;
    }

    $stmt->close();
  

} else { 
  echo 'Failure'; 
}

?>
