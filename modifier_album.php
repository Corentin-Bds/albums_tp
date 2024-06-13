<?php
// Connexion à la base de données
$cnx = mysqli_connect("localhost", "root", "", "albums");

if (mysqli_connect_errno()) {
    echo "Echec de la connexion : " . mysqli_connect_error();
    exit();
}

// Vérifier si les données du formulaire sont envoyées pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $album_id = $_POST['album_id'];
    $nouveau_nom = $_POST['nom'];

    // Requête de mise à jour
    $sql = "UPDATE albums SET nomAlb='$nouveau_nom' WHERE idAlb=$album_id";

    // Exécuter la requête
    if (mysqli_query($cnx, $sql)) {
        echo "Le nom de l'album a été mis à jour avec succès.";
        echo "<br>";
        echo "<a href='index.php'>revenir à la page d'accueil</a>";
        exit();
    } else {
        echo "Erreur lors de la mise à jour: " . mysqli_error($cnx);
    }
}

// Récupération des albums depuis la base de données
$sql = "SELECT idAlb, nomAlb FROM albums";
$result = mysqli_query($cnx, $sql);

if (!$result) {
    echo "Erreur lors de la récupération des albums : " . mysqli_error($cnx);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le nom de l'album</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div>
            <p>Sélectionnez un album à modifier :</p>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div>
                    <input type="radio" id="album_<?php echo $row['idAlb']; ?>" name="album_id" value="<?php echo $row['idAlb']; ?>" required>
                    <label for="album_<?php echo $row['idAlb']; ?>"><?php echo htmlspecialchars($row['nomAlb']); ?></label>
                </div>
            <?php endwhile; ?>
        </div>
        <div>
            <label for="nom">Entrer le nouveau nom de votre album :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <input type="submit" value="Modifier">
        </div>

        
    </form>
</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($cnx);
?>