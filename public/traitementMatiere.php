<?php

require_once '../classes/GestionNotes.php';


if (!empty($_POST)) {

    $gestionNotes = new GestionNotes();

    $gestionNotes->ajouterMatiere(
        $_POST['nomMatiere'], 
        $_POST['codeMatiere'], 
        $_POST['bareme'], 
      

    );
     header('Location: index.php');
}