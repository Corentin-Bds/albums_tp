<?php

session_start();

if ( empty($_POST)){
?>
    <form action="login.php" method="POST">
    <input type="text" name="login">
    <input type="password" name="password">
    <input type="submit" value="Envoyer">
</form>
<?php 
} else {
    $cnx = mysqli_connect("localhost", "root", "", "albums");

    if(mysqli_connect_errno()){
        echo "Echec de la connexion : ".mysqli-connect_error();
        exit();
    }
    $sql = "SELECT * FROM user WHERE login='".$_POST["login"]."'AND password='".$_POST["password"]."'";

    $res = mysqli_query($cnx, $sql);
    
    if (mysqli_num_rows($res) == 1) {
        $_SESSION['auth'] = true;
        header('Location: index.php');
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}
?>