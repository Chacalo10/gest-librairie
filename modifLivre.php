<!-- fichier modifLivre.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des livres</title>
</head>

<body>
    <?php
    include("librairie/variables.inc.php");
    function redirection($url)
    {
        header("location: $url ");
        exit();
    }
    $con = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
    if ($con->connect_error) {
        die("Erreur : échec de connexion à la base de données. Essayez plus tard. " . $con->connect_error);
    }
    $codeLivre = $_POST['codeLivre'];
    $isbn = $_POST['isbn'];
    $auteur = $_POST['auteur'];
    $titre = $_POST['titre'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];

    $requete = "UPDATE livres SET ISBN = '$isbn', auteur = '$auteur', titre = '$titre', stock = $quantite, pu = $prix WHERE codeLivre = $codeLivre";
    if ($con->query($requete) === TRUE) {
        echo "success";
    } else {
        echo "eroor";
    }
    $con->close();
    redirection("rechLivres.html");
    ?>
</body>

</html>