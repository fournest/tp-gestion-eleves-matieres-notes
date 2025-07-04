<?php

require_once '../classes/GestionNotes.php';


if (!empty($_POST)) {

    $gestionNotes = new GestionNotes();

    $gestionNotes->attibuerNote(
        $_POST['idEtudiant'], 
        $_POST['idMatiere'], 
        $_POST['valeurNote']
       

    );
     header('Location: index.php');
}