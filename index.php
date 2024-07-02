<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="" href="ajouter_album.php">
    <title>TP PHP/SQL</title>
</head>
<body>
    
<h1>Mes albums</h1>
<?php
$cnx = mysqli_connect("localhost", "root", "", "albums");

if(mysqli_connect_errno()){
    echo "Echec de la connexion : ".mysqli-connect_error();
    exit();
}

// Requête SQL pour sélectionner un idAlb aléatoire
if(!isset($_GET["id"])){
    $sql = "SELECT idAlb FROM albums ORDER BY RAND() LIMIT 1";
    $res = mysqli_query($cnx, $sql);
    $_GET["id"] = mysqli_fetch_array($res)["idAlb"];
}

$sql = "SELECT * from albums";
$res = mysqli_query($cnx, $sql);

echo '<div>';
while ($ligne = mysqli_fetch_array($res)){
    echo '<a href="index.php?id='.$ligne['idAlb'].'">'.$ligne['nomAlb'].'</a><br/>';
}
echo '<a href="corbeille.php">Corbeille</a>';
echo '<a href="ajouter_album.php">+</a>';
echo '<a href="modifier_album.php?id='.$_GET["id"].'">!</a>';
echo '<a href="supprimer_album.php?id='.$_GET["id"].'">X</a>';
echo '</div>';

$sql = "SELECT photos.idPh, photos.nomPh FROM comporter JOIN photos ON comporter.idPh = photos.idPh WHERE comporter.idAlb = " . $_GET["id"] . " AND photos.visible = 1";
$res = mysqli_query($cnx, $sql);

while ($ligne = mysqli_fetch_array($res)){
    echo '<img src="photos/'.$ligne['nomPh'].'" />';
    echo '<a href="modifier_photo.php?idAlb='.$_GET['id'].'&idPh='.$ligne['idPh'].'">! </a>';
    echo '<a href="retirerPhoto.php?idAlb=' . $_GET['id'] . '&idPh=' . $ligne['idPh'] . '"> X</a>';
}

echo '<a href="ajouter_photo.php"> +</a>';

mysqli_free_result($res);

mysqli_close($cnx);
?>

</body>
</html>

<!--
    Create
    Read
    Update
    Delete
-->