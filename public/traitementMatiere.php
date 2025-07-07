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

    $gestionNotes->ajouterMatiere(
        $_POST['nomMatiere'],
        $_POST['codeMatiere'],
        $_POST['bareme'],


    );
    header('Location: index.php');
}
