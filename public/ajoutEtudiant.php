<?php

session_start();
require_once '../includes/head.php';
require_once '../classes/GestionNotes.php';
require_once '../includes/Database.php';
require_once '../includes/menu.php';
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Requête CSRF détectée.');
    }
}

$gestionNotes = new GestionNotes();
$etudiants = $gestionNotes->listerEtudiants();


?>

<h2>Ajouter un étudiant</h2>

<form action="traitementEtudiant.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label for=""> Nom : </label>
    <input type="text" name="nom">
    <label for="">Prenom : </label>
    <input type="text" name="prenom">
    <label for="">Matricule : </label>
    <input type="text" name="matricule">
    <label for="">Date de naissance : </label>
    <input type="date" name="dateNaissance">

    <input type="submit" value="Enregistrez le nouvel étudiant.">
</form>


<?php

require_once '../includes/footer.php';
