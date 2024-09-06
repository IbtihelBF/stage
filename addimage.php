<?php
include 'connect.php';
session_start();
session_regenerate_id(true);

if (isset($_POST['ajouter'])) {
    $description = $_POST['description'];
    $target_dir = "C:/xampp/htdocs/stage/image/";
    $image = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    // Check if the file is a real image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("Le fichier n'est pas une image.");
    }

    // Check the file size
    if ($_FILES["image"]["size"] > 5000000) { // Limit to 5MB
        die("Désolé, votre fichier est trop volumineux.");
    }

    // Allow certain file formats
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedFormats)) {
        die("Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
    }

    // Attempt to move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        // Save only the relative path in the database
        $imageRelativePath = "image/" . basename($_FILES['image']['name']);

        // Prepare the SQL statement to avoid SQL injection
        $stmt = $connect->prepare("INSERT INTO produit (description, image_path) VALUES (?, ?)");
        
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Erreur lors de la préparation de la requête : " . $connect->error);
        }

        // Bind parameters and execute the statement
        if (!$stmt->bind_param("ss", $description, $imageRelativePath)) {
            die("Erreur lors du binding des paramètres : " . $stmt->error);
        }

        if ($stmt->execute()) {
            // Redirect to index.php after successful insertion
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://pikwizard.com/pw/medium/5845e1912e7fa2a5d45f913cc401bbca.jpg')no-repeat center center fixed ; 
            background-size: cover;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 5rem;
            border-radius: 10px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            font-family: 'Roboto', sans-serif; /* Changed to Roboto for a clearer style */
            font-weight: 700; /* Bold weight for better emphasis */
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
        <h1>Add Image</h1>
        <input type="text" name="description" placeholder="Description de l'image" required><br>
        <input type="text" name="name" placeholder="nom de l'image" required><br>
        <input id="fileupload" type="file" name="fileupload" />
        <!--<button id="upload-button" > Upload </button>-->
        <form>
        <input type="submit" name="ajouter" value="Ajouter l'image">
        </form>
    </div>



    <script>

$('form').submit(function() {
        
        let formData = new FormData(); 
        formData.append("file", fileupload.files[0]);
        $.ajax({
          url: 'upload.php',
          type: 'POST',
          data: formData,
          async: true,
          cache: false,
          contentType: false,
          enctype: 'multipart/form-data',
          processData: false,
          beforeSend: function () {
           
          },
          success: function (response) {
            window.location.href = "index.php";
          }
       });
       return false;
    });

  </script>
</body>
</html>
