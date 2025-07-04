<?php



class Matiere {

    protected $id;
    protected $nomMatiere;
    protected $codeMatiere;




    

public function __construct($nomMatiere, $codeMatiere)
    {
        $this->nomMatiere = $nomMatiere;
        $this->codeMatiere = $codeMatiere;
        
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
     * Get the value of nomMatiere
     */ 
    public function getNomMatiere()
    {
        return $this->nomMatiere;
    }

    /**
     * Set the value of nomMatiere
     *
     * @return  self
     */ 
    public function setNomMatiere($nomMatiere)
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    /**
     * Get the value of codeMatiere
     */ 
    public function getCodeMatiere()
    {
        return $this->codeMatiere;
    }

    /**
     * Set the value of codeMatiere
     *
     * @return  self
     */ 
    public function setCodeMatiere($codeMatiere)
    {
        $this->codeMatiere = $codeMatiere;

        return $this;
    }
}