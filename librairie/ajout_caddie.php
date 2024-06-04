<!-- 
    
 /* include("variables.inc.php");
setcookie("monpanier",$_COOKIE['monpanier'].",".$_REQUEST['id']);
header("Location: $url/boutique.php?id=".$_REQUEST['id']);
 */  -->

<?php
    include("variables.inc.php");
    if(isset($_POST['id'])) {
        $idLivre = $_POST['id'];
        if(isset($_COOKIE['monpanier'])) {
            $monpanier = $_COOKIE['monpanier'] . "," . $idLivre;
        }
        else {
            $monpanier = $idLivre;
        }
        setcookie('monpanier', $monpanier, time() + (86400 * 30), "/");
        header("Location: $url/boutique.php?id=".$_REQUEST['id']);
        exit();
        
    }
    else {
        header("Location: $url/boutique.php?id=".$_REQUEST['id']);
        
    }

?>
