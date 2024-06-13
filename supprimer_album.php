<?php
// Connexion à la base de données
$cnx = mysqli_connect("localhost", "root", "", "albums");

if (mysqli_connect_errno()) {
    echo "Echec de la connexion : " . mysqli_connect_error();
    exit();
}

// Vérifier si les données du formulaire sont envoyées pour la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    // Récupérer l'ID de l'album à supprimer
    $album_id = $_POST['album_id'];
    // Échapper les variables pour éviter les injections SQL
    $album_id = mysqli_real_escape_string($cnx, $album_id);

    // Requête de suppression
    $sql = "DELETE FROM albums WHERE idAlb=$album_id";

    // Exécuter la requête de suppression
    if (mysqli_query($cnx, $sql)) {
        echo "L'album a été supprimé avec succès.";
        echo "<br>";
        echo "<a href='index.php'>Retourner à la page d'accueil</a>";
        exit();
    } else {
        echo "Erreur lors de la suppression: " . mysqli_error($cnx);
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
    <title>Supprimer un album</title>
</head>
<body>
    <h2>Supprimer un album</h2>
    <form action="" method="post">
        <label for="album_id">Sélectionnez l'album à supprimer :</label>
        <select name="album_id" id="album_id" required>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $row['idAlb']; ?>"><?php echo htmlspecialchars($row['nomAlb']); ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" name="supprimer" value="Supprimer">
    </form>
</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($cnx);
?>