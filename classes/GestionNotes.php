<?php

require_once '../includes/Database.php';
require_once '../classes/Etudiant.php';



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

    public function attibuerNote($idEtudiant, $idMatiere, $valeurNote)
    {
        if (!empty($_POST)) {
            $sql =  "INSERT INTO  notes ( id_etudiant, id_matiere, valeurNote)
             VALUES(:id_etudiant, :id_matiere, :valeurNote)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_etudiant' => $idEtudiant,
                'id_matiere' => $idMatiere,
                'valeurNote' => $valeurNote,
            ]);
            header('Location: index.php');
        }
    }


    public function calculerMoyenneEtudiant($idEtudiant)
    {
        $sql = "SELECT AVG(valeurNote) AS moyenneEleve FROM etudiants JOIN notes 
        ON etudiants.id = notes.id_etudiant 
        WHERE etudiant.id = :idEtudiant
        ORDER BY valeurNote DESC ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

       
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
        $sql = "SELECT * FROM notes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }
}
