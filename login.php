<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
            z-index: 1;
            animation: containerAnimation 1s ease-out;
        }
        @keyframes containerAnimation {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        .container h2 {
            margin-bottom: 1.5rem;
            color: #fff;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        .form-group {
            margin-bottom: 1rem;
            animation: fadeIn 1s ease-in-out;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 700;
            color: #fff;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .btn:active {
            transform: translateY(0);
        }
        .error {
            color: red;
            margin-top: 1rem;
            animation: shake 0.3s ease-in-out;
        }
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="background-video">
        <source src="https://media.istockphoto.com/id/1307214497/video/intelligent-cpu-processing-big-data-in-futuristic-computer.mp4?s=mp4-640x640-is&k=20&c=eqMjeWYMReROSUFLEtjn0Qrp96NJzYPfDyoM1SOeD80=" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>
    <div class="container">
        <h2>Login</h2>
        <form action="authenticate.php" method="post" id="loginForm">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="error" id="error"></div>
        </form>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', function(event) {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorDiv = document.getElementById('error');
            
            if (username === '' || password === '') {
                event.preventDefault();
                errorDiv.textContent = 'Please fill out all fields.';
                errorDiv.style.animation = 'shake 0.3s ease-in-out';
            } else {
                errorDiv.textContent = '';
                errorDiv.style.animation = '';
            }
        });
    </script>
</body>
</html>
