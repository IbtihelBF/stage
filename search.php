<?php

/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];

/* Choose where to save the uploaded file */
$location = "uploads/".$filename;

/* Save the uploaded file to the local filesystem */
if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
    $images="";
  $output = exec("py -X utf8 lens.py ". $filename ." search 0.55",$out);

  foreach($out as $im){
    $images=$images."<img src='image/" . $im . "'</img>";
  }
  echo $images;
} else { 
  echo 'Failure'; 
}

?>
