<?php
// Affichage du formulaire
if (empty($_POST)){
?>
<html>
    <head>
    </head>
    <body>
        <form action="ajouter_album.php" method="post">
            <div>
                <label for="albums">Entrez le nom de votre album: </label>
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
    // Connexion BDD
    $cnx = mysqli_connect("localhost", "root", "", "albums");

    if(mysqli_connect_errno()){
        echo "Echec de la connexion : ".mysqli-connect_error();
        exit();
    }

    $sql='INSERT INTO albums SET nomAlb="'.$_POST["nomAlb"].'"';
    //echo $sql;
    mysqli_query($cnx, $sql);
    $id=mysqli_insert_id($cnx);
    header("Location: index.php?id=".$id);
}

 ?>
