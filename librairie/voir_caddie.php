<?php
session_start();
include("variables.inc.php");
$db = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
if ($db->connect_error) {
    die("Connexion échouée : " . $db->connect_error);
}

echo "<div class='titre'><a href='boutique.php'>Boutique <i>Librairie</i></a></div>";
echo "<div class='caddie'>";
$montant = 0;
$listeproduits = "";
if (isset($_COOKIE['monpanier']) && $_COOKIE['monpanier'] != '') {
    $tab = array_count_values(explode(",", $_COOKIE['monpanier']));
    $ids = implode(',', array_map('intval', array_keys($tab)));
    $sql = "SELECT * FROM $livres WHERE codeLivre IN ($ids)";
    if ($resultat = $db->query($sql)) {
        echo "<table width='90%'>";
        while ($livre = $resultat->fetch_assoc()) {
            echo "<tr><td class='produit'>";
            echo "[" . $livre['REF'] . "] " . $livre['titre'];
            echo "(x " . $tab[$livre['codeLivre']] . ")";
            echo "</td><td class='montant'>";
            echo $livre['pu'] * $tab[$livre['codeLivre']];
            echo "</td></tr>";
            $montant += $livre['pu'] * $tab[$livre['codeLivre']];
            $listeproduits .= ',' . $livre['REF'];
        }
        echo "</table>";
    }
    $db->close();
}
$listeproduits = ltrim($listeproduits, ',');
$montant += 1000; // frais de livraison
echo "<div class='total'>Montant + Frais (1000) : $montant </div>";
?>
<link rel="stylesheet" href="styles/voir_caddie.css">
<form action="enreg_cde.php" method="post">
    <input type="hidden" name="montant" value="<?php echo $montant; ?>" />
    <input type="hidden" name="listesproduits" value="<?php echo $listeproduits; ?>" />
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value=" <?php echo isset($_SESSION['valid_user']) ? $_SESSION['valid_user'] : ''; ?>"/> 
    </div>
    <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required placeholder="Entrez votre adresse" />
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required placeholder="Entrez votre email" />
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" placeholder="Entrez votre numéro de téléphone" />
    </div>

    <a href="boutique.php">Annuler la commande</a>
    <input type="submit" value="Enregistrer la commande" />
</form>
</div>

<style>
    
</style>