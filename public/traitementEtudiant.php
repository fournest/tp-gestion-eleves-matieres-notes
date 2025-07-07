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

    $gestionNotes->ajouterEtudiant(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['matricule'],
        $_POST['dateNaissance'],

    );
    header('Location: index.php');
}
