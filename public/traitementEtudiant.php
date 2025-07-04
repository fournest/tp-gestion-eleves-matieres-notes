<?php

require_once '../classes/GestionNotes.php';


if (!empty($_POST)) {

    $gestionNotes = new GestionNotes();

    $gestionNotes->ajouterEtudiant(
        $_POST['nom'], 
        $_POST['prenom'], 
        $_POST['matricule'], 
        $_POST['dateNaissance'], 

    );
     header('Location: index.php');
}