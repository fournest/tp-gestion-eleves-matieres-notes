<?php

include_once '../includes/Database.php';
require_once '../classes/Etudiant.php';
require_once '../classes/Matiere.php';
require_once '../classes/Note.php';
require_once '../classes/GestionNotes.php';
include_once '../includes/head.php';
include_once '../includes/menu.php';


$gestionNotes = new GestionNotes();
$etudiants = $gestionNotes->listerEtudiants();
$matieres = $gestionNotes->listerMatieres();
$notes = $gestionNotes->listerNotes();



?>


<h2>Les etudiants</h2>

<div class="container">


    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Matricule</th>
            <th>Date de Naissance</th>
        </tr>

        <?php


        foreach ($etudiants as $etudiant):
            $dateNaissance = new DateTime($etudiant['dateNaissance']);
            $dateNaissanceFormatee = $dateNaissance->format('d/m/Y');
        ?>
            <tr>
                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                <td><?= htmlspecialchars($etudiant['matricule']) ?></td>
                <td><?= htmlspecialchars($dateNaissanceFormatee) ?></td>
                <td>
                    <a href="modifierEtudiant.php?id=<?= $etudiant['id'] ?>">Modifier</a> |
                    <a href="supprimer.php?id=<?= $etudiant['id'] ?>" onclick="return confirm('Supprimer cet élève ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


    <table>

        <tr>
            <th>Nom de la matière</th>
            <th>Code de la matière</th>
            <th>Barème</th>

        </tr>

        <?php
        foreach ($matieres as $matiere):

        ?>
            <tr>
                <td><?= htmlspecialchars($matiere['nomMatiere']) ?></td>
                <td><?= htmlspecialchars($matiere['codeMatiere']) ?></td>
                <td><?= htmlspecialchars($matiere['bareme']) ?></td>

                <td>
                    <a href="modifierMatiere.php?id=<?= $matiere['id'] ?>">Modifier</a> |
                    <a href="supprimer.php?id=<?= $matiere['id'] ?>" onclick="return confirm('Supprimer cette matière ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>



    </table>

    <table>

        <tr>
            <th>Nom de l'élève</th>
            <th>Prénom de l'élève</th>
            <th>Matricule de l'élève</th>
            <th>Nom de la matière</th>
            <th>Note obtenue</th>

        </tr>

        <?php
        foreach ($notes as $note):

        ?>
            <tr>
                <td><?= htmlspecialchars($note['nom']) ?></td>
                <td><?= htmlspecialchars($note['prenom']) ?></td>
                <td><?= htmlspecialchars($note['matricule']) ?></td>
                <td><?= htmlspecialchars($note['nomMatiere']) ?></td>
                <td><?= htmlspecialchars($note['valeurNote']) ?></td>

                <td>
                    <a href="modifierNotes.php?id=<?= $note['id'] ?>">Modifier</a> |
                    <a href="supprimer.php?id=<?= $note['id'] ?>" onclick="return confirm('Supprimer cette note ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>



    </table>

</div>



<?php

include_once '../includes/footer.php';
