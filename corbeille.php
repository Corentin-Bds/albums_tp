<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        
        <h1>Corbeille</h1>
        <?php
        $cnx = mysqli_connect("localhost", "root", "", "albums");
        
        if (mysqli_connect_errno()) {
            die("Echec de la connexion : " . mysqli_connect_error());
        }
        
        // Requête SQL pour sélectionner toutes les photos masquées
        $sql = "SELECT * FROM photos WHERE visible = 0";
        $res = mysqli_query($cnx, $sql);
        
        if ($res) {
            while ($ligne = mysqli_fetch_array($res)) {
                echo '<div>';
                echo '<img src="photos/' . $ligne['nomPh'] . '" alt="' . $ligne['nomPh'] .'"/>';
                echo '<a href="restaurerPhoto.php?idPh=' . $ligne['idPh'] . '">Restaurer</a>';
                echo '<a href="supprimer_photo.php?idPh=' . $ligne['idPh'] . '">Supprimer</a>';
                echo '</div>';
            }
            mysqli_free_result($res);
        } else {
            echo "Erreur dans la requête SQL : " . mysqli_error($cnx);
        }
        
        mysqli_close($cnx);
        ?>
    
    </body>
</html>