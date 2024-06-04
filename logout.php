<!-- fichier logout.php -->
<?php
session_start();
if (isset($_SESSION['valid_user'])) { 
    $old_user = $_SESSION['valid_user']; // pour savoir ensuite si l’utilisateur a été connecté
    
    unset($_SESSION['valid_user']);
    
    session_destroy();
}
if (isset($_SESSION['valid_admin'])) { 
    
    $old_admin = $_SESSION['valid_admin'];
    
    unset($_SESSION['valid_admin']);
    session_destroy();
}
?>
<html>

<head>
    <title>Deconection</title>
    <link rel="stylesheet" href="styles/logout.css">
</head>

<body>
    <div class="cont">
        <div class="cont-header">
            <h1>Fermeture de la SESSION</h1>
        </div>
        <?php
        if (!empty($old_user)) {
            echo ' <p><b> session fermée.<br/> </b><p/>';
        } elseif(!empty($old_admin)) {
            echo ' <p><b> session fermée.<br/> </b><p/>';
        } else {
            // si l’utilisateur n’avait pas pu ouvrir une session mais qui est parvenu à cette page
            echo '<p>Pas besoin de fermer la session car elle n’a pas été ouverte pour vous.<p/>';
        }
        ?>

        
        <div class="link">
            <a href="authmain.php">Page principale</a>
        </div>
        

    </div>
</body>

</html>