<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php 
    $cnx = mysqli_connect("localhost", "root", "", "albums");

    if (mysqli_connect_errno()){
        echo "Echec de la connexion : ".mysqli_connect_error();
        exit();
    }

    $sql = "SELECT * from albums";
    $res = mysqli_query($cnx, $sql);

    echo "<h1>Mes albums</h1>";

    echo "<div id='nav'>";

    while ($ligne = mysqli_fetch_array($res)) {
        echo '<a href="index.php?id='.$ligne["idAlb"].'">'.$ligne["nomAlb"].'</a>';
    }
    echo "<a href='ajouter_album.php'>Ajouter album</a>";
    echo "<a href='modifier_album.php'>Modifier album</a>";
    echo "<a href='supprimer_album.php'>Supprimer album</a>";
    echo "</div>";

    $sql = "SELECT * from comporter, photos WHERE comporter.idPh = photos.idPh AND idAlb =".$_GET["id"];
    $res = mysqli_query($cnx, $sql);
    echo "<div id='test1'";
    echo "<div id='test'>";
    while ($ligne = mysqli_fetch_array($res)) {
        echo "<div class='test2'>";
        echo '<img src="photos/'.$ligne["nomPh"].'"/>';
        echo "<a href='modifier_photo.php' class='lien'>Modifier la photo</a>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    mysqli_free_result($res);

    mysqli_close($cnx);



?>