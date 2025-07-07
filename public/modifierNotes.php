<?php
include_once '../includes/head.php';
require_once '../classes/Etudiant.php';
require_once '../classes/Matiere.php';
require_once '../classes/Note.php';
require_once '../classes/GestionNotes.php';
include_once '../includes/menu.php';
include_once '../includes/Database.php';


// $gestionNotes = new GestionNotes();
// $etudiants = $gestionNotes->listerEtudiants();
// $matieres = $gestionNotes->listerMatieres();
// $notes = $gestionNotes->listerNotes();

session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


$pdo = Database::getConnection();

if (!empty($_POST)) {
    $sql = "UPDATE valeurNote SET notes WHERE notes.id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'notes.id' => $_POST['notes.id'],
        'etudiants.nom' => $_POST['etudiants.nom'],
        'etudiants.prenom' => $_POST['etudiants.prenom'],
        'etudiants.matricule' => $_POST['etudiants.matricule'],
        'matieres.nomMatieres' => $_POST['matieres.nomMatieres'],
        'valeurNote' => $_POST['valeurNote']

    ]);

    header('Location: index.php');
}

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $noteId = $_GET['id'];

    $sql = "SELECT notes.id, etudiants.nom, etudiants.prenom, etudiants.matricule, matieres.nomMatiere, valeurNote FROM notes JOIN etudiants ON notes.id_etudiant = etudiants.id JOIN matieres ON notes.id_matiere = matieres.id WHERE notes.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $noteId]);
    $note = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Modifiez la note de votre élève ici!</h2>

<form action="modifierNotes.php?id=<?= $note['id'] ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <input type="hidden" name="id" value="<?= htmlspecialchars($note['id']) ?>">
    <label for=""> Le nom de l'étudiant : </label>
    <p><?= htmlspecialchars($note['nom']) ?></p>
    <label for="">Le prénom de l'étudiant : </label>
    <p><?= htmlspecialchars($note['prenom']) ?></p>
    <label for="">Le matricule de l'étudiant : </label>
    <p><?= htmlspecialchars($note['matricule']) ?></p>
    <label for="">La nom de la matière : </label>
    <p><?= htmlspecialchars($note['nomMatiere']) ?></p>
    <label for="">La note de l'étudiant : </label>
    <input type="text" name="valeurNote" value="<?= htmlspecialchars($note['valeurNote']) ?>">



    <input type="submit" value="Modifiez les informations">
</form>


<?php


include '../includes/footer.php';
