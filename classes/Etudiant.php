<?php


class Etudiant
{

    private $id;
    private $nom;
    private $prenom;
    private $matricule;
    
    
    public function __construct($nom, $prenom, $matricule)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->matricule = $matricule;
    }
    
    
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        
        return $this;
    }
    
    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    
    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        
        return $this;
    }
    /**
     * Get the value of matricule
     */
    public function getMatricule()
    {
        return $this->matricule;
    }
    
    /**
     * Set the value of matricule
     *
     * @return  self
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
        
        return $this;
    }
    
    
}