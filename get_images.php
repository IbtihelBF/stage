<?php
include 'connect.php'; 
$query = "SELECT id, image_path FROM images";
$result = mysqli_query($conn, $query);

$images = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row;
    }
}
mysqli_close($conn);
header('Content-Type: application/json');
echo json_encode($images);
?>
