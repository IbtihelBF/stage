<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: url('https://pikwizard.com/pw/medium/5845e1912e7fa2a5d45f913cc401bbca.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .home-symbol {
            position: absolute;
            top: 0.5rem;
            left: 1rem;
            background-color: #000;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }
        .home-symbol:hover {
            background-color: #0066FF;
        }
        .home-symbol i {
            margin-right: 0.5rem;
        }
        .add-image-button {
            position: absolute;
            top: 0.5rem;
            right: 2rem; 
            background: linear-gradient(135deg, #0066FF, #004080);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            display: flex;
            align-items: center;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            border: 1px solid #0056b3;
        }
        .add-image-button i {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }
        .add-image-button:hover {
            background: linear-gradient(135deg, #0056b3, #003d80);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        }
        .add-image-button:active {
            transform: scale(1);
        }
        h1 {
            font-family: 'Arial', cursive;
            text-align: center;
            margin-bottom: 2rem;
            color: #00BFFF; /* Light blue color */
            font-weight: 900; /* Extra bold */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            width: 80%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.45);
            border-radius: 8px;
        }
        .gallery-item {
            position: relative;
        }
        .gallery img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            object-fit: contain;
            object-position: center;
            background-color: #000;
        }
        .gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: none;
            color: #ccc;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            opacity: 0.7;
            transition: color 0.3s ease, opacity 0.3s ease;
        }
        .delete-btn:hover {
            color: #0066FF;
            opacity: 1;
        }
    </style>
</head>
<body>
    <a href="home.php" class="home-symbol"><i class="fas fa-home"></i> HOME</a>
    <a href="addimage.php" class="add-image-button">
        <i class="fas fa-plus-circle"></i> Add Image
    </a>
    <h1>Image Gallery</h1>
    <div class="gallery" id="gallery">
    <?php
        include 'connect.php';
        $result = $connect->query("SELECT * FROM produit");
        while ($row = $result->fetch_assoc()) {
            echo '<div class="gallery-item">';
            echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Image">';
            // Pass the image path to the delete function
            echo '<button class="delete-btn" onclick="deleteImage(\'' . htmlspecialchars($row['image_path']) . '\')"><i class="fas fa-trash-alt"></i></button>';
            echo '</div>';
        }
    ?>
    </div>

    <script>
        function deleteImage(imagePath) {
            if (confirm("Are you sure you want to delete this image?")) {
                // Encode the image path to safely include it in the URL
                const encodedImagePath = encodeURIComponent(imagePath);
                // Redirect to the PHP script with the image path as a parameter
                window.location.href = 'delete_image.php?image_path=' + encodedImagePath;
            }
        }
    </script>
</body>
</html>
