<?php
session_start();
require_once '../classes/GestionNotes.php';


if (!empty($_POST)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die('Requête CSRF détectée.');
        }
    }
    $gestionNotes = new GestionNotes();

    $gestionNotes->attribuerNote(
        $_POST['idEtudiant'],
        $_POST['idMatiere'],
        $_POST['valeurNote']


    );
    header('Location: index.php');
}
