<?php

session_start();
require_once '../includes/head.php';
require_once '../classes/GestionNotes.php';
require_once '../includes/Database.php';
require_once '../includes/menu.php';

$gestionNotes = new GestionNotes();
$matieres = $gestionNotes->listerMatieres();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


?>

<h2>Ajouter une matière</h2>

<form action="traitementMatiere.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label for=""> Nom de la matière : </label>
    <input type="text" name="nomMatiere">
    <label for="">Code de la matière : </label>
    <input type="text" name="codeMatiere">

    <input type="submit" value="Enregistrez la  nouvelle matière.">
</form>


<?php

require_once '../includes/footer.php';
