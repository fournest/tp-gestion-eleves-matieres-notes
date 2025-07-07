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
    $sql = 'UPDATE matieres SET nomMatiere = :nomMatiere, codeMatiere = :codeMatiere, bareme = :bareme WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'id' => $_POST['id'],
        'nomMatiere' => $_POST['nomMatiere'],
        'codeMatiere' => $_POST['codeMatiere'],
        'bareme' => $_POST['bareme']
    ]);

    header('Location: index.php');
}

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $matiereId = $_GET['id'];

    $sql = 'SELECT * FROM matieres WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $matiereId]);
    $matiere = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Modifiez les informations de votre matière ici!</h2>

<form action="modifierMatiere.php?id=<?= $matiere['id'] ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <input type="hidden" name="id" value="<?= htmlspecialchars($matiere['id']) ?>">
    <label for=""> Le nom de la matière : </label>
    <input type="text" name="nomMatiere" value="<?= htmlspecialchars($matiere['nomMatiere']) ?>">
    <label for="">Le code de la matière : </label>
    <input type="text" name="codeMatiere" value="<?= htmlspecialchars($matiere['codeMatiere']) ?>">
    <label for="">Le barème : </label>
    <input type="text" name="bareme" value="<?= htmlspecialchars($matiere['bareme']) ?>">
    
  
   
    <input type="submit" value="Modifiez les informations">
</form>


<?php


include '../includes/footer.php';
