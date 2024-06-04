<!--fichier results.php-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque - catalogue des livres</title>
    <link rel="stylesheet" href="styles/results.css">
    <link rel="stylesheet" href="styles/css/all.css">
</head>

<body>
    <h1>RECHERCHE D'UN LIVRE</h1>
    <?php
    include("librairie/variables.inc.php");

    $db = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
    if ($db->connect_error) {
        die("Erreur : échec de connexion à la base de données. Essayez plus tard. " . $db->connect_error);
    }

    $typeRech = $_POST['typeRech'];

    if(isset($_POST['termeRech'])) {
        $termeRech = $_POST['termeRech'];
        $termeRech = trim($termeRech);
    
    

        if (!$typeRech || !$termeRech) {
            echo "Vous n'avez entré aucun critère de recherche. Réessayez ! <br /> <br />";
            echo "<a href='rechLivres.html' class='acceuil'>Acceuil</a>";
            exit;
        }

        $typeRech = addslashes($typeRech);
        $termeRech = addslashes($termeRech);

        $requete = "SELECT * FROM livres WHERE " . $typeRech . " LIKE '%" . $termeRech . "%' ";
        $resultat = $db->query($requete);
        $num_result = $resultat->num_rows;
    }
    else {
        $requete = "SELECT * FROM livres";
        $resultat = $db->query($requete);
        $num_result = $resultat->num_rows;
    }
    
    

    

    echo '<p>Nombre de livres trouvés : ' . $num_result . '</p>';

    for ($i = 0; $i < $num_result; $i++) {
        $row = $resultat->fetch_assoc();
        echo '<div class="result-container">';
        
        echo '<div class="result-info" style=">CodeLivre : ' . $row['codeLivre'] . '</div>';
        
        echo '<div class="result-header"><strong>' . ($i + 1) . '. Titre : ' . htmlspecialchars($row['titre']) . '</strong></div><br />';
        
        echo '<table>';
        echo '<tr>'; 
        echo '<td><div class="result-info">Auteur : </td><td class = "valeur">' . $row['auteur'] . '</div></td>';
        echo '</tr>';
        echo '<tr>'; 
        echo '<td><div class="result-info">ISBN : </td><td class = "valeur">' . $row['ISBN'] . '</div></td>';
        echo '</tr>';
        echo '<tr>'; 
        echo '<td><div class="result-info">Quantité : </td><td class = "valeur">' . $row['stock'] . '</div></td>';
        echo '</tr>'; 
        echo '<tr>'; 
        echo '<td><div class="result-info">Prix : </td><td class = "valeur">' . $row['pu'] . '</div></td>';
        echo '</tr>';
        echo '</table>';
        echo '<div class="icon-pencil-container">';
        echo '<a href="modifLivre.html?codeLivre=' . urlencode($row['codeLivre']) . '&isbn=' . urlencode($row['ISBN']) . '&auteur=' . urlencode($row['auteur']) . '&titre=' . urlencode($row['titre']) . '&quantite=' . urlencode($row['stock']) . '&prix=' . urlencode($row['pu']) . '">';
        echo '<svg class="icon-pencil" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">';
        echo '<path d="M2,21l1-4L16,2l4,4L6,20H2z"/>';
        echo '<path d="M14.5,3.5l4,4L7,19.5l-4-4L14.5,3.5z"/>';
        echo '<path d="M15,4l1,1l-4,4l-1-1L15,4z"/>';
        echo '</svg>';
        echo '</a>';
        echo '</div>';
        echo '<div class="icon-trash-container">';
        echo '<a href="supLivres" ><i class="fas fa-trash"></i></a>';   
        echo '</div>';
        echo '</div>';
    }

    echo "<a href='rechLivres.html' class='acceuil'>Acceuil</a>";
    ?>
    
</body>

</html>