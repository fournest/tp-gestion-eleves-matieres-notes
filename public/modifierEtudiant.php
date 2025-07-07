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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Requête CSRF détectée.');
    }
}

$pdo = Database::getConnection();

if (!empty($_POST)) {
    $sql = 'UPDATE etudiants SET nom = :nom, prenom = :prenom, matricule = :matricule, dateNaissance = :dateNaissance WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'id' => $_POST['id'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'matricule' => $_POST['matricule'],
        'dateNaissance' => $_POST['dateNaissance']
    ]);

    header('Location: index.php');
}

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $etudiantId = $_GET['id'];

    $sql = 'SELECT * FROM etudiants WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $etudiantId]);
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Modifiez les informations de votre élève ici!</h2>

<form action="modifierEtudiant.php?id=<?= $etudiant['id'] ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <input type="hidden" name="id" value="<?= htmlspecialchars($etudiant['id']) ?>">
    <label for=""> Le nom de l'étudiant : </label>
    <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>">
    <label for="">Le prénom de l'étudiant : </label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>">
    <label for="">Le matricule de l'étudiant : </label>
    <input type="text" name="matricule" value="<?= htmlspecialchars($etudiant['matricule']) ?>">
    <label for="">La date de naissance de l'étudiant : </label>
    <input type="date" name="dateNaissance" value="<?= htmlspecialchars($etudiant['dateNaissance']) ?>">
  
   
    <input type="submit" value="Modifiez les informations">
</form>


<?php


include '../includes/footer.php';
