<!-- fichier inscription.php -->
<?php
    include("librairie/variables.inc.php");
    
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    
    $base = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
    $requet = "INSERT INTO auth (`name`, `pass`)
    VALUES (?, ?)";
    $stmt = $base->prepare($requet);
    $stmt->bind_param("ss",$name,$pass);
        
    if ($stmt->execute()) {
        echo "Nouveau enregistrement créé avec succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    $stmt->close();
    $base->close();
    header("location: authmain.php ");
  
?>