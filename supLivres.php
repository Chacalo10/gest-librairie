<!--fichier supLivre.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de livre</title>
</head>
<body>
        <form name = "form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >   
        <input type="text" name = "name">
        
        <input type="submit" value="Enregistrer">
        </form>


    <?php
        
        echo '<pre>';
        print_r($_POST);
        echo '<pre>';
    ?>
</body>
</html>