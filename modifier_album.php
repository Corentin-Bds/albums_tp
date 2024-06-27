<?php
// Connexion BDD
$cnx = mysqli_connect("localhost", "root", "", "albums");

    if(mysqli_connect_errno()){
        echo "Echec de la connexion : ".mysqli-connect_error();
        exit();
    }
// Affichage du formulaire
if (empty($_POST)){
    $sql="SELECT * FROM albums WHERE idAlb=".$_GET["id"];
    $res = mysqli_query($cnx, $sql);
    $nomAlb=mysqli_fetch_array($res)["nomAlb"];
?>
<html>
    <head>
    </head>
    <body>
        <form action="modifier_album.php?id=<?= $_GET["id"]?>" method="post">
            <div>
                <label for="albums">Retapez le nom de votre album: </label>
                <input type="text" name="nomAlb" required />
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
    $sql='UPDATE albums SET nomAlb="'.$_POST["nomAlb"].'" WHERE idAlb='.$_GET["id"];
    //echo $sql;
    mysqli_query($cnx, $sql);
    header("Location: index.php?id=".$_GET["id"]);
}

 ?>
