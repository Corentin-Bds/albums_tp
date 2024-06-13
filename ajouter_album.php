<?php
//affichage du formulaire
    if (empty ($_POST)){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Formulaire d'ajout d'un album</title>
        </head>
        <body>
            <form action="" method="post">
                <div>
                    <label for="albums">Entrer le nom de votre album :</label>
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
    //traitement du formulaire
    else {
        
        $cnx = mysqli_connect("localhost", "root", "", "albums");

        if (mysqli_connect_errno()){
            echo "Echec de la connexion : ".mysqli_connect_error();
            exit();
        }

        $sql = "INSERT INTO albums SET nomAlb='".$_POST["nomAlb"]."'";
        mysqli_query($cnx, $sql);

        $id = mysqli_insert_id($cnx);
        header("Location: index.php?id=".$id);
    }
?>