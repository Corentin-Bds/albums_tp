<?php
// Connexion BDD
$cnx = mysqli_connect("localhost", "root", "", "albums");

    if(mysqli_connect_errno()){
        echo "Echec de la connexion : ".mysqli-connect_error();
        exit();
    }
// Affichage du formulaire
if (empty($_POST)){
    $sql="SELECT * FROM albums";
    $res = mysqli_query($cnx, $sql);
?>
<html>
    <head>
    </head>
    <body>
        <form action="supprimer_album.php?id=<?= $_GET["id"]?>" method="post">
            <div>
                <label for="albums">Voulez vous supprimer l'album <?= $_GET["id"]?> ? <br/></label>
                <input type="checkbox" name="question" value="oui"/> Oui
                <input type="checkbox" name="question" value="non"/> Non
            </div>
            <div>
                <input type="submit" value="Envoyer" />
            </div>
        </form>
    </body>
</html>
<?php
}
// Traitement du formulaire
else{
    $sql='DELETE FROM comporter WHERE idAlb='.$_GET["id"];
    mysqli_query($cnx, $sql);
    $sql='DELETE FROM albums WHERE idAlb='.$_GET["id"];
    mysqli_query($cnx, $sql);
    $sql='SELECT * FROM photos WHERE idPh NOT IN(
        SELECT DISTINCT idPh FROM comporter  
        ORDER BY `comporter`.`idPh`
    );';
    $res=mysqli_query($cnx, $sql);
    while ($ligne = mysqli_fetch_array($res)){
        unlink("photos/".$ligne["nomPh"]);
    }

    $sql='DELETE FROM photos WHERE idPh NOT IN(
                SELECT DISTINCT idPh FROM comporter  
                ORDER BY `comporter`.`idPh`
            );';
    mysqli_query($cnx, $sql);
    //echo $sql;
    header("Location: index.php?id=".$_GET["id"]);
}

 ?>


