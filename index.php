<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS similaire à ce que vous avez fourni */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: url('https://st2.depositphotos.com/1579454/10998/i/450/depositphotos_109988168-stock-photo-abstract-technology-background-3d-render.jpg') no-repeat center center fixed;
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
        h1 {
            font-family: 'Pacifico', cursive;
            text-align: center;
            margin-bottom: 2rem;
            color: #48cae4;
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
        .gallery img {
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <a href="home.php" class="home-symbol"><i class="fas fa-home"></i> HOME</a>
    <h1>Image Gallery</h1>
    <div class="gallery" id="gallery">
        <?php
        include 'connect.php'; // Connexion à la base de données

        $result = $conn->query("SELECT ID, description, image FROM image");
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='" . $row['description'] . "'>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
