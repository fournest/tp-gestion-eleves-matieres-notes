<?php

require_once '../includes/head.php';
require_once '../includes/header.php';
require_once '../includes/Database.php';
require_once '../includes/menu.php';





?>

<h2>Ajouter un étudiant</h2>

<form action="traitementMatiere.php" method="POST">

    <label for=""> Nom de la matière : </label>
    <input type="text" name="nomMatiere">
    <label for="">Code de la matière : </label>
    <input type="text" name="codeMatiere">
      
    <input type="submit" value="Enregistrez la  nouvelle matière.">
</form>


<?php

require_once '../includes/footer.php';