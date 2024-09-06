
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page - Image Search</title>
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
            justify-content: flex-start;
            background: url('https://i.pinimg.com/564x/ab/a7/78/aba778a6c37f450634e904cd35f14be7.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #000080;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 100px;
            height: auto;
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
            font-family: 'Arial', cursive;
            text-align: center;
            margin-top: 2rem;
            color: #000080;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .upload-section {
            margin-top: 1rem;
            padding: 5rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            text-align: center;
            color: #000080;
            font-weight: bold;
            font-size: 1.2rem;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(6.1px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .upload-section input[type="file"] {
            margin-top: 2rem;
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
            color: #000080;
        }
        .results-section h2 {
            color: #fff;
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
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY2AzsUWfke_7c91m69-4rpsmP_-fSzRndlg&s" alt="Sartex Logo" class="logo">

    <a href="login.php" class="login-button"><i class="fas fa-sign-in-alt"></i> Login</a>

    <h1>Image Similarity Search</h1>

    <div class="upload-section">
        <p>Upload an image to find similar ones:</p>
        <input id="fileupload" type="file" name="fileupload" />
        <!--<button id="upload-button" > Upload </button>-->

        <form>
        <input type="submit" value="submit"/> 
        </form>
       

        
    <!--<form method="post" action="upload" enctype="multipart/form-data">
            <input type="file" name="image" id="imageUpload" accept="image/*">
            <input type="submit" >Find Similar Images</input>
     </form> -->
    </div>

    <div class="results-section" id="results">
        <h2>Similar Images:</h2>
        <div class="results-gallery" id="resultsGallery">
            
        </div>
    </div>
<script>

$('form').submit(function() {
        
        
        //$('#resultsGallery').addClass("loader");
        let formData = new FormData(); 
        formData.append("file", fileupload.files[0]);
        
        $.ajax({
          url: 'search.php',
          type: 'POST',
          data: formData,
          async: true,
          cache: false,
          contentType: false,
          enctype: 'multipart/form-data',
          processData: false,
          beforeSend: function () {
            $('#resultsGallery').html("<div class='loader'></div>");
          },
          success: function (response) {
            $('#resultsGallery').html(response);
             
          }
       });
       return false;
    });

  </script>
</body>

</html>
