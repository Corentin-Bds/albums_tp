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
        <form action="supprimer_photo.php?idAlb=<?= $_GET['idAlb'] ?>&idPh=<?=$_GET['idPh'] ?>" method="post">
            <div>
                <label for="photo">Voulez vous supprimer la photo <?= $_GET["idPh"]?> ? <br/></label>
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
    $sql='SELECT nomPh FROM photos WHERE idPh='.$_GET["idPh"];
    $res=mysqli_query($cnx, $sql);
    $nomPh=mysqli_fetch_array($res)["nomPh"];
    unlink('photos/'.$nomPh);
    $sql='DELETE FROM comporter WHERE idPh="'.$_GET["idPh"].'"';
    mysqli_query($cnx, $sql);
    $sql='DELETE FROM photos WHERE idPh="'.$_GET["idPh"].'"';
    mysqli_query($cnx, $sql);
    //echo $sql;
    header("Location: index.php?id=".$_GET["id"]);
}

 ?>


