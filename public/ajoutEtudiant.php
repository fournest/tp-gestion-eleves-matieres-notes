<?php

require_once '../includes/head.php';
require_once '../includes/header.php';
require_once '../includes/Database.php';
require_once '../includes/menu.php';





?>

<h2>Ajouter un étudiant</h2>

<form action="traitementEtudiant.php" method="POST">

    <label for=""> Nom : </label>
    <input type="text" name="nom">
    <label for="">Prenom : </label>
    <input type="text" name="prenom">
    <label for="">Matricule : </label>
    <input type="text" name="matricule">
    <label for="">Date de naissance : </label>
    <input type="text" name="dateNaissance" >
    
    <input type="submit" value="Enregistrez le nouvel étudiant.">
</form>


<?php

require_once '../includes/footer.php';