<!-- fichier member_only.php -->

<!DOCTYPE html>
    <html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acceuil Membre</title>
        <link rel="stylesheet" href="styles/members_only.css">
    </head>
<?php
session_start();
echo '<div class="cont"><div class="cont-header"><h1>Membres uniquement</h1></div>';
// vérification de la variable de session
if (isset($_SESSION['valid_user'])) {
?>
    

    

    <body>
        <div class="cont-form">
            <form action="librairie/boutique.php" method="post">
                <p><?php echo 'Vous êtes connecté(e) en tant que ' . $_SESSION['valid_user']; ?></p>
                <input type="submit" value="Voir les livres" class="lien">

    </body>
<?php
} else {
    echo "<p>Vous n'avez pa eu accès.</p>";
    echo '<p>seuls les membres connectés voient cette page.</p>';
}
echo '<div class="link"><a href="authmain.php" class = "prin" id = "aj">retour page principale</a></div></form></div></div>';
?>

    </html>