<?php

include_once '../includes/Database.php';
require_once '../classes/Etudiant.php';
require_once '../classes/Matiere.php';
require_once '../classes/Note.php';
require_once '../classes/GestionNotes.php';
include_once '../includes/head.php';
include_once '../includes/header.php';
include_once '../includes/menu.php';

echo "Bonjour";




?>


<div class="container">
    <h2>Les etudiants</h2>
   
</div>

<a href="ajoutEtudiant.php">➕ Ajouter un etudiant</a>
<a href="ajoutMatiere.php">➕ Ajouter une matière</a>
<a href="attribuerNote.php">➕ Ajouter une note</a>
<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Matricule</th>
        <th>Date de Naissance</th>
        <th>Notes</th>
    </tr>

    <?php
   

    foreach ($etudiants as $etudiant):

    ?>
        <tr>
            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
            <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
            <td><?= htmlspecialchars($etudiant['matricule']) ?></td>
            <td><?= htmlspecialchars($etudiant['dateNaissance']) ?></td>
             <td><?= htmlspecialchars($etudiant['notes']) ?></td>
            <td>
                <a href="modifier.php?id=<?= $etudiant['id'] ?>">Modifier</a> |
                <a href="supprimer.php?id=<?= $etudiant['id'] ?>" onclick="return confirm('Supprimer cet élève ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>




<?php

include_once '../includes/footer.php';


