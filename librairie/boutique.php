<!--fichier boutique.php-->
<?php

include("variables.inc.php");

//unset($_COOKIE['monpanier']);
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 1;

if (!isset($_REQUEST['id'])) $id = 1;
    else $id = $_REQUEST['id'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Librairie - catalogue</title>
    <link rel="stylesheet" href="styles/boutique.css">
</head>
<body>
    <div class='titre'>
        Boutique <i> Librairie </i>
    </div>
    <table class='catalogue'>
        <tr>
            <td class='liste'>
                <div class='tdTitre'>Nos livres</div>
                <?php

                
                $db = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
                if ($db->connect_error) {
                    die("Connexion échouée : " . $db->connect_error);
                }
                
                $sql = "SELECT * FROM $livres";
                $resultat = $db->query($sql);
                while ($livre = $resultat->fetch_assoc()) {
                    $activeClass = ($livre['codeLivre'] == $id) ? 'livre-actif' : '';
                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?id=" . $livre['codeLivre'] . "' class='$activeClass'>" . $livre['titre'] . "</a><br/>";
                }
                ?>
            </td>
            <td class='detail'>
                <?php
                
                $sql = "SELECT * FROM $livres WHERE codeLivre = '$id'";
                $resultat = $db->query($sql);
                $produit = $resultat->fetch_assoc();
                echo "<div class='tdTitre'>[ref :" . $produit['REF'] . "]</div>";
                ?>
                <div class='description'>
                    <?php
                    echo "ISBN: " . nl2br($produit['ISBN']) . "<br/><br/>";
                    echo "Auteur : " . nl2br($produit['auteur']) . "<br/><br/>";
                    echo "Stock : " . $produit['stock'] . "<br/><br/>";
                    echo "Prix : " . $produit['pu'] . " Fcfa <br/><br/>";
                    ?>
                    <form action="ajout_caddie.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" value="ajouter au panier" />
                    </form>
                    <?php
                    // Affichage du contenu du panier si le cookie existe
                    if (isset($_COOKIE['monpanier'])) {
                        echo "<div class='panier'>";
                        $tab = explode(",", $_COOKIE['monpanier']);
                        $nblivres = sizeof($tab) - 1;

                        echo "Dans votre panier : " . $nblivres . " livre(s)<br/>";
                        echo "<form action='voir_caddie.php' method='post'>";                       
                        echo "<div id = 'cmd' >";
                        echo "<input type='submit' value='voir la commande'/></form>";                      
                        echo "</div>";
                        echo "</div>";
                    }
                    $db->close();
                    ?>
                </div>
                <a href="../authmain.php" class="bhome">Page principale</a>
            </td>
        </tr>
    </table>
</body>

</html>