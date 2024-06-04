<?php
    include("variables.inc.php");

    if(empty($_REQUEST['nom'])||empty($_REQUEST['adresse']))
        die("erreur : il y a des champs vides !");


    $db = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
    if ($db->connect_error) {
        die("Connexion échouée : " . $db->connect_error);
    }

    $montant = 0;
    //$listeproduits = "";
    $date = date("Y-m-d G:i:s");
    $_COOKIE['monpanier'][0];
    $tab_livre = explode(",", $_COOKIE['monpanier']);
    $i = 0;

    while($id = $tab_livre[$i]){
        $sql = "SELECT * FROM $livres WHERE codeLivre = '$id'";
        $resultat = $db->query($sql);
        $livre = $resultat->fetch_assoc();
        $montant += $livre['pu'];
        $listeproduits .= ','.$livre['REF'];
        $i++;
    }

    $listeproduits[0] = '';
    $montant += 1000;
    $date = date("Y-m-d G:i:s");
    $sql = "INSERT INTO $cdes (produits, montantcde, nomPrenomCli, adressecli, dateCde) VALUES ('$listeproduits','$montant','".$_REQUEST['nom']."','".$_REQUEST['adresse']."','$date')";
    $db->query($sql);

 
setcookie("monprofil","nom = ".$_REQUEST['nom'].";;adresse = ".$_REQUEST['adresse'], time() + 604800);

setcookie("monpanier","",time()-3600);
 $db->close();

 
 header("Location: $url/boutique.php");

    echo '<pre>';
    print_r($listeproduits);
    echo '</pre>';
 

?>