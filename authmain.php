<!-- fichier authmain.php -->
<?php
    session_start();

    //permet d'integrer les variables de connexion à la base de donnée qui se trouve dans le fichier variables.php
    include("librairie/variables.inc.php");

    if (isset($_REQUEST['userid']) && isset($_REQUEST['password'])) {
        // Si l'utilisateur a essayé d'ouvrir une session
        $userid = $_REQUEST['userid'];
        $password = $_REQUEST['password'];

        // Connexion à la base de données avec mysqli
        $db_connect = new mysqli($bdserver, $bdlogin, $bdpwd, $bd);
        if ($db_connect->connect_error) {
            die("Erreur de connexion à la base de données : " . $db_connect->connect_error);
        }

        // Prépare la requête de l'utilisateur
        $query = "SELECT * FROM auth WHERE name = ? AND pass = ?";
        $stmt = $db_connect->prepare($query);
        $stmt->bind_param("ss", $userid, $password);
        $stmt->execute();
        $result1 = $stmt->get_result();

        if ($result1->num_rows > 0) {
            // S'il est enregistré dans la base de données
            $_SESSION['valid_user'] = $userid;
        }

        // Prépare la requête de l'administrateur
        $query = "SELECT * FROM auth_admin WHERE name = ? AND pass = ?";
        $stmt = $db_connect->prepare($query);
        $stmt->bind_param("ss", $userid, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // S'il est enregistré dans la base de données
            $_SESSION['valid_admin'] = $userid;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page d'accès</title>
        <link rel="stylesheet" href="styles/authmain.css">
    </head>
    <body>
        <div class="login">
            <div class="login-header"><h1>Page d'accès</h1></div>
            <div class="login-form">
                <?php
                    if (isset($_SESSION['valid_user'])) {
                        echo '<br>';
                        echo '<div class="connect-user">';
                        echo '<p>Vous êtes connecté(e) en tant que : ' . $_SESSION['valid_user'] . '</p>';
                        echo '</div>';
                        echo '<div class = "l"><a href="logout.php" class = "d">Fermer votre session</a></div><br />';
                    } elseif(isset($_SESSION['valid_admin'])) {
                        echo '<br>';
                        echo '<div class="connect-admin">';
                        echo '<p>Vous êtes connecté(e) en tant que : ' . $_SESSION['valid_admin'] . '<br /></p>';
                        echo '</div>';
                        echo '<div class = "li"><a href="logout.php" class = "d1">Fermer votre session</a>';
                        echo '<a href="rechLivres.html" class="d2" >Section administrateur</a></div>';
                        
                    } else {

                        if (isset($userid)) {
                            echo '<p class="dennied"><b> ! Accès refusé ! </b></p>';
                        } else {
                            echo 'Vous n’êtes pas connecté(e).<br />';
                        }
                        echo '<form method="post" action="authmain.php">';
                        echo '<h3>Login</h3>';
                        echo '<label for="name">Identité :</label>';
                        echo '<input type="text" name="userid" id="name" value = "">';
                        echo '<label for="pass">Mot de passe :</label>';
                        echo '<input type="password" name="password" id="pass" value = "" >';
                        echo '<input type="submit" value="Entrer">';
                        echo '</form>';
                    }
                ?>
                <br>
                <div class="bottom">
                    <a href="members_only.php" class="srm">Section réservée aux membres</a>
                    <a href="inscription.html" class="srm" >S'inscrire</a>
                </div>
                    
                
            </div>
        </div>
        
    </body>
</html>