<?php
    include 'connect.php';
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        echo "Login successful! Welcome " . $_SESSION['username'];
    } else {
        echo "Invalid username or password";
    }
    $stmt->close();
    $conn->close();
?>
