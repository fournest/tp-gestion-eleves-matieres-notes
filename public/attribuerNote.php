<?php

require_once '../includes/head.php';
require_once '../includes/header.php';
require_once '../includes/Database.php';
require_once '../includes/menu.php';
require_once '../classes/GestionNotes.php';


$gestionNotes = new GestionNotes();
$etudiants = $gestionNotes->listerEtudiants();
$matieres = $gestionNotes->listerMatieres();


?>

<h2>Attribuer une note</h2>

<form action="traitementNote.php" method="POST">
    <label for=""> Nom de l'élève : </label>
     <select name="idEtudiant" id="nom">
        <option value="">-- Sélectionez un élève --</option>
        <?php foreach ($etudiants as $etudiant) : ?>
            <option value="<?= htmlspecialchars($etudiant['id']); ?>">
                <?= htmlspecialchars($etudiant['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="">Nom de la matière : </label>
     <select name="idMatiere" id="matiere">
        <option value="">-- Sélectionez une matière --</option>
        <?php foreach ($matieres as $matiere) : ?>
            <option value="<?= htmlspecialchars($matiere['id']); ?>">
                <?= htmlspecialchars($matiere['nomMatiere']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for=""> Note de l'élève : </label>
    <input type="text" name="valeurNote">
      
    <input type="submit" value="Enregistrez la  nouvelle note.">
</form>


<?php

require_once '../includes/footer.php';