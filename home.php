<?php
// Start PHP block for handling image upload
$uploaded_images = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    // Check if the file was uploaded without errors
    if ($_FILES['image']['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadedFile = $uploadDir . basename($_FILES['image']['name']);

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
            // Simulate finding similar images (replace with your own logic)
            $uploaded_images = [
                $uploadedFile, // Show the uploaded image itself
                'path/to/similar/image1.jpg',  // Example similar images
                'path/to/similar/image2.jpg',
                'path/to/similar/image3.jpg'
            ];
        } else {
            echo '<script>alert("Failed to move the uploaded file.");</script>';
        }
    } else {
        echo '<script>alert("Error during file upload.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page - Image Search</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Same CSS as before */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background: url('https://st2.depositphotos.com/1579454/10998/i/450/depositphotos_109988168-stock-photo-abstract-technology-background-3d-render.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .login-button {
            position: absolute;
            top: 0.5rem;
            right: 1rem;
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
        .login-button:hover {
            background-color: #0066FF;
        }
        .login-button i {
            margin-right: 0.5rem;
        }
        h1 {
            font-family: 'Pacifico', cursive;
            text-align: center;
            margin-top: 2rem;
            color: #48cae4;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .upload-section {
            margin-top: 3rem;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            text-align: center;
            color: #333;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .upload-section input[type="file"] {
            margin-top: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #000080;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 1rem;
        }
        .btn:hover {
            background-color: #0066FF;
            transform: translateY(-2px);
        }
        .btn:active {
            transform: translateY(0);
        }
        .results-section {
            margin-top: 2rem;
            width: 80%;
            max-width: 1000px;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.45);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .results-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }
        .results-gallery img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            object-fit: contain;
            background-color: #000;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .results-gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <!-- Login Button -->
    <a href="login.php" class="login-button"><i class="fas fa-sign-in-alt"></i> Login</a>

    <!-- Page Title -->
    <h1>Image Similarity Search</h1>

    <!-- Upload Section -->
    <div class="upload-section">
        <p>Upload an image to find similar ones:</p>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="imageUpload" accept="image/*">
            <button class="btn" type="submit">Find Similar Images</button>
        </form>
    </div>

    <!-- Results Section -->
    <div class="results-section" id="results">
        <h2>Similar Images:</h2>
        <div class="results-gallery" id="resultsGallery">
            <!-- Display uploaded and similar images -->
            <?php
            if (!empty($uploaded_images)) {
                foreach ($uploaded_images as $image) {
                    echo "<img src='$image' alt='Similar Image'>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
