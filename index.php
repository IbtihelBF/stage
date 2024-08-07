<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Similar Pictures</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            text-align: center;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 90%;
            max-width: 600px;
            position: relative;
            z-index: 1;
        }
        .container h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .upload-container {
            position: relative;
            margin-bottom: 2rem;
        }
        .upload-container input[type="file"] {
            display: none;
        }
        .upload-button {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 1rem 2rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .upload-button:hover {
            background: #0056b3;
        }
        .upload-icon {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 1rem;
        }
        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .search-bar input {
            width: 80%;
            padding: 1rem;
            border: 2px solid #007bff;
            border-radius: 25px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .search-bar input:focus {
            border-color: #0056b3;
        }
        .search-bar button {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 1rem 2rem;
            margin-left: 1rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-bar button:hover {
            background: #0056b3;
        }
        .footer {
            position: absolute;
            bottom: 1rem;
            width: 100%;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Find Similar Pictures</h1>
        <div class="upload-container">
            <label for="upload" class="upload-button">
                <span class="upload-icon">📸</span>
                Upload Image
            </label>
            <input type="file" id="upload" accept="image/*">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search for similar images...">
            <button type="button">Search</button>
        </div>
        <div class="footer">
            <p>&copy; 2024 FindSimilarPics. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
