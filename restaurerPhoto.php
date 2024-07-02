<?php
$cnx = mysqli_connect("localhost", "root", "", "albums");

if (mysqli_connect_errno()) {
    echo "Echec de la connexion : " . mysqli_connect_error();
    exit();
}

$photo_id = $_GET['idPh'];
$album_id = $_GET['idAlb'];

$sql = "UPDATE photos SET visible = 1 WHERE idPh = $photo_id";

if (mysqli_query($cnx, $sql)) {
    header("Location: index.php?id=$album_id");
} else {
    echo "Erreur: " . mysqli_error($cnx);
}

mysqli_close($cnx);
?>