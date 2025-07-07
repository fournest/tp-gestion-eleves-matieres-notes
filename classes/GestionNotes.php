<?php

require_once '../includes/Database.php';
require_once '../classes/Etudiant.php';
require_once '../classes/Matiere.php';
require_once '../classes/Note.php';



class GestionNotes
{

    private $pdo;
    public static $moyenneEleve = 0;


    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function ajouterEtudiant($nom, $prenom, $matricule, $dateNaissance)
    {

        $sql =  "INSERT INTO etudiants ( nom, prenom, matricule, dateNaissance)
             VALUES(:nom, :prenom, :matricule, :dateNaissance)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'matricule' => $matricule,
            'dateNaissance' => $dateNaissance
        ]);
    }

    public function ajouterMatiere($nomMatiere, $codeMatiere, $bareme)
    {
        if (!empty($_POST)) {
            $sql =  "INSERT INTO  matieres ( nomMatiere, codeMatiere, bareme)
             VALUES(:nomMatiere, :codeMatiere, :bareme)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nomMatiere' => $nomMatiere,
                'codeMatiere' => $codeMatiere,
                'bareme' => $bareme,
            ]);
            header('Location: index.php');
        }
    }

    public function attribuerNote($idEtudiant, $idMatiere, $valeurNote)
    {
        if (!empty($_POST)) {
            if ($valeurNote < 0 || $valeurNote > 20) {
                echo "Erreur : la note doit être comprise entre 0 et 20.";
            } else {
                $sql =  "INSERT INTO notes (id_etudiant, id_matiere, valeurNote)
             VALUES(:id_etudiant, :id_matiere, :valeurNote)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'id_etudiant' => $idEtudiant,
                    'id_matiere' => $idMatiere,
                    'valeurNote' => $valeurNote,
                ]);
            }
            header('Location: index.php');
        }
    }


    public function calculerMoyenneEtudiant($idEtudiant)
    {
        $sql = "SELECT AVG(valeurNote) AS moyenneEleve FROM etudiants JOIN notes 
        ON etudiants.id = notes.id_etudiant 
        WHERE etudiants.id = :idEtudiant
        ORDER BY valeurNote DESC ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idEtudiant' => $idEtudiant]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['moyenneEleve'] : null;
    }

    public function listerEtudiants()
    {
        $sql = "SELECT * FROM etudiants";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $etudiants;
    }
    public function listerMatieres()
    {
        $sql = "SELECT * FROM matieres";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $matieres;
    }

    public function listerNotes()
    {
        $sql = "SELECT notes.id, etudiants.nom, etudiants.prenom, etudiants.matricule, matieres.nomMatiere, valeurNote FROM notes JOIN etudiants ON notes.id_etudiant = etudiants.id JOIN matieres ON notes.id_matiere = matieres.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }
}
