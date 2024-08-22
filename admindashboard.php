<?php
session_start();

// Check if user is logged in as admin
// if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
//     header("Location: index.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<link rel="stylesheet" href="css/sty.css">
<body>
<section>
        <nav>
            <ul class="menu">
                <li>
                    <h1><a href="index.php" > HOME</a></h1>
                </li>
                <li>
                <li>
                    <h1><a href="logout.php">LOGOUT</a></h1>
                    
                </li>
            </ul>
            </nav>
    <h2>Tableau de bord Admin</h2>
    <p>Bienvenue</p>
    <section >
    <h1 class="title">Latest events:</h1>
    <div class="container">
        <?php
        // Connexion à la base de données
        include 'connexion.php';
        // Récupérer tous les produits avec leurs images
        $sql = "SELECT * FROM events"; // Remplacez "products" par le nom de votre table
        $result = $connexion->query($sql);
        if ($result->num_rows > 0) {
            // Afficher tous les produits avec leurs images
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $name = $row["name"];
                $description = $row["description"];
                $image_path = $row["image"];
            }}
        ?>
                <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>function</th>
        </tr>
        <?php
        while($row=$result->fetch_assoc()){
            
        ?>
        <tr>
        <td><?php echo $row['id'];  ?></td>
            <td><?php echo $row['name'];  ?></td>
            <td><?php echo $row['description'];  ?></td>
            <td><?php echo $row['image'];  ?></td>
            <td>
                <?php
                echo "<a href='updateevent.php?id={$row['id']}'><img src='img/updated_5334981.png' width='30' heigth='30'></a>";
                echo "&nbsp;&nbsp;";
                echo "<a href='delete.php?id={$row['id']}'><img src='img/trash-bin_2623134.png' width='30' heigth='30'></a>";
            ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <a classe="main-btn" href="createevent.php">add event</a>
    
    </section>
    <section>
    <h1 class="title">Latest Formations: </h1>
    <div class="content">

<?php
        // Connexion à la base de données
        //include 'connexion.php';
        // Récupérer tous les produits avec leurs images
        $sql2 = "SELECT * FROM formations"; // Remplacez "products" par le nom de votre table
        $result2 = $connexion->query($sql2);
        if ($result2->num_rows > 0) {
            // Afficher tous les produits avec leurs images
            while ($row = $result2->fetch_assoc()) {
                $id = $row["id"];
                $name = $row["name"];
                $description = $row["description"];
                $image_path = $row["image"];

        ?>
                <table border>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>function</th>
        </tr>
        <?php
        while($row=$result2->fetch_assoc()){
            
        ?>
        <tr>
        <td><?php echo $row['id'];  ?></td>
            <td><?php echo $row['name'];  ?></td>
            <td><?php echo $row['description'];  ?></td>
            <td><?php echo $row['image'];  ?></td>
            <td>
                <?php
                echo "<a href='updateformation.php?id={$row['id']}'><img src='img/updated_5334981.png' width='30' heigth='30'></a>";
                echo "&nbsp;&nbsp;";
                echo "<a href='delete.php?id={$row['id']}'><img src='img/trash-bin_2623134.png' width='30' heigth='30'></a>";
            ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
        <?php
            }
        } else {
            echo "Aucun produit trouvé.";
        }
        ?>
        
    </div>
    <a classe="main-btn" href="createformation.php">add Formation</a>
</section>

<h1 class="title">Les membres: </h1>
    <div class="content">
<?php 
$sql1="SELECT * FROM users";
$result1=$connexion->query($sql1);
?>
    <table border>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>email</th>
            <th>password</th>
            <th>role</th>
            <th>function</th>
        </tr>
        <?php
        while($row=$result1->fetch_assoc()){
            
        ?>
        <tr>
        <td><?php echo $row['name'];  ?></td>
            <td><?php echo $row['username'];  ?></td>
            <td><?php echo $row['email'];  ?></td>
            <td><?php echo $row['password'];  ?></td>
            <td><?php echo $row['role'];  ?></td>

            <td>
                <?php
                echo "<a href='updateusers.php?username={$row['username']}'><img src='img/updated_5334981.png' width='30' heigth='30'></a>";
                echo "&nbsp;&nbsp;";
                echo "<a href='delete.php?username={$row['username']}'><img src='img/trash-bin_2623134.png' width='30' heigth='30'></a>";
            ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
    </b
    
</body>
</html>
