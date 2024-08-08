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
            background-color:#0066FF;
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
        .selection {
            margin-top: 2rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            text-align: center;
            color: #333;
            max-width: 400px;
        }
        .selection p {
            margin: 0.5rem 0;
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
        }
        .btn:hover {
            background-color: #0066FF;
            transform: translateY(-2px);
        }
        .btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <a href="home.php" class="home-symbol"><i class="fas fa-home"></i> HOME</a>
    <h1>Image Gallery</h1>
    <div class="gallery" id="gallery">
    </div>
    <div class="selection" id="selection">
        <p id="selectedImageText">No image selected</p>
        <button class="btn" onclick="findSimilar()">Find Similar Images</button>
    </div>

    <script>
        let selectedImageId = null;

        function loadImages() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_image.php', true);
            xhr.onload = function() {
                if (this.status === 200) {
                    const images = JSON.parse(this.responseText);
                    const gallery = document.getElementById('gallery');
                    images.forEach(image => {
                        const img = document.createElement('img');
                        img.src = image.image_path;
                        img.alt = 'Image';
                        img.onclick = () => selectImage(image.id);
                        gallery.appendChild(img);
                    });
                }
            }
            xhr.send();
        }
        function selectImage(imageId) {
            selectedImageId = imageId;
            document.getElementById('selectedImageText').textContent = 'Selected Image ID: ' + imageId;
        }
        function findSimilar() {
            if (selectedImageId) {
                window.location.href = 'find_similar.php?image_id=' + selectedImageId;
            } else {
                alert('Please select an image first.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadImages);
    </script>
</body>
</html>
