<!--fichier enreLivre.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultat enregistrement</title>
</head>
<body>
    <?php
    function redirection($url){
      header("location: $url ");
      exit();
    }
    
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "Moi";
$password = "motdepass";
$dbname = "biblio";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Échec de la connexion: " . $conn->connect_error);
}

// Récupérer les données du formulaire

$isbn = $_POST['isbn'];
$auteur = $_POST['auteur'];
$titre = $_POST['titre'];
$quantite = $_POST['quantite'];
$pu = $_POST['prix'];

// Préparer la requête SQL
$sql = "INSERT INTO livres (codeLivre, ISBN, auteur, titre, stock, pu)
VALUES (NULL, ?, ?, ?, ?, ?)";

// Préparer la déclaration
$stmt = $conn->prepare($sql);

// Lier les paramètres
$stmt->bind_param("ssssi", $isbn, $auteur, $titre, $quantite , $pu);

// Exécuter la déclaration
if ($stmt->execute()) {
  echo "Nouveau enregistrement créé avec succès";
} else {
  echo "Erreur: " . $stmt->error;
}

// Fermer la déclaration
$stmt->close();

// Fermer la connexion
$conn->close();
    
redirection("rechLivres.html");
    ?>
</body>
</html>