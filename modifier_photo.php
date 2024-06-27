<?php
// Connexion BDD
$cnx = mysqli_connect("localhost", "root", "", "albums");

    if(mysqli_connect_errno()){
        echo "Echec de la connexion : ".mysqli-connect_error();
        exit();
    }
// Affichage du formulaire
if (empty($_POST)){
    /*$sql="SELECT * FROM albums WHERE idAlb=".$_GET["idPh"];
    $res = mysqli_query($cnx, $sql);
    $nomAlb=mysqli_fetch_array($res)["nomAlb"];*/
?>
<html>
    <head>
    </head>
    <body>
        <form action="modifier_photo.php?idAlb=<?= $_GET['idAlb'] ?>&idPh=<?=$_GET['idPh'] ?>" method="post">
            <div>
                <?php
                $sql = "SELECT albums.*, 1 AS has FROM albums INNER JOIN comporter ON albums.idAlb=comporter.idAlb WHERE idPh=".$_GET['idPh']."
                        UNION
                        SELECT albums.*, 0 AS has FROM albums WHERE idAlb NOT IN(
                            SELECT albums.idAlb FROM albums INNER JOIN comporter ON albums.idAlb=comporter.idAlb WHERE idPh=".$_GET['idPh']."
                        );";
                $res = mysqli_query($cnx, $sql);

                echo '<div>';
                while ($ligne = mysqli_fetch_array($res)){
                    echo '<input '.($ligne['has']==1?" Checked ":"").' type="checkbox" name="albums[]" value="'.$ligne["idAlb"].'" />'.$ligne['nomAlb'].'<br/>';
                    $sql='SELECT * FROM comporter WHERE idAlb';
                }
                ?>
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
    $sql='DELETE FROM comporter WHERE idPh='.$_GET["idPh"];
    mysqli_query($cnx, $sql);

    foreach($_POST["albums"] AS $idAlb){
        $sql='INSERT INTO comporter SET idAlb='.$idAlb.', idPh='.$_GET["idPh"];
        mysqli_query($cnx, $sql);
    }
    header("Location: index.php?id=".$_GET['idAlb']);
}

 ?>
