<?php
// Connexion BDD
$cnx = mysqli_connect("localhost", "root", "", "albums");

if(mysqli_connect_errno()){
    echo "Echec de la connexion : ".mysqli-connect_error();
    exit();
}
// Affichage du formulaire
if (empty($_POST)){
?>
<html>
    <head>
    </head>
    <body>
        <form action="ajouter_photo.php" method="post" enctype="multipart/form-data">
            <div>
                <?php
                $sql = "SELECT * from albums";
                $res = mysqli_query($cnx, $sql);

                echo '<div>';
                while ($ligne = mysqli_fetch_array($res)){
                    echo '<input type="checkbox" name="albums[]" value="'.$ligne["idAlb"].'" />'.$ligne['nomAlb'].'<br/>';
                }
                ?>
            </div>
            <div>
                <input type="file" name="photo" />
            </div>
            <div>
                <input type="submit" name="Envoi" value="Envoyer" />
            </div>
        </form>
    </body>
</html>
<?php
}
// Traitement du formulaire
else{
    //Enregitrement à vide dans la table photos
    $sql='INSERT INTO photos (nomPh) VALUES (" ")';
    $res = mysqli_query($cnx, $sql);
    //Récupérer idPh correspondant
    $idPh=mysqli_insert_id($cnx);
    //Générer le nom de la photo
    $nomPh="ph_".$idPh.".jpg";
    //Modifier la table photos avec le bon nom
    $sql='UPDATE photos SET nomPh="'.$nomPh.'" WHERE idPh='.$idPh;
    $res = mysqli_query($cnx, $sql);
    //Stocker la photo avec le bon nom
    move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/".$nomPh);
    //Lier la photo aux divers albums
    foreach($_POST["albums"] AS $idAlb){
        $sql='INSERT INTO comporter (idAlb, idPh) VALUES ('.$idAlb.', '.$idPh.')';
        $res = mysqli_query($cnx, $sql);
    }
    header("Location: index.php?id=".$_POST["albums"][0]);
}

 ?>
