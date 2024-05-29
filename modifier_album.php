<?php
//affichage du formulaire
    if (empty ($_POST)){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Formulaire de modification du nom de l'album</title>
        </head>
        <body>
            <form action="" method="post">
                <div>
                    <input type="text" value="" required />

                    <label for="albums">Entrer le nouveau nom de votre album :</label>
                    <input type="text" name="nom" required>
                </div>
                <div>
                    <input type="submit" value="Envoyer" />
                </div>
            </form>
        </body>
        </html>
    <?php 
    }
