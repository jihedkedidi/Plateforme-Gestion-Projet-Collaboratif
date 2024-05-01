<?php 
class employee
{
    public $nom;
    public $prenom;
    public $role;

    function __construct($nom = "",$date_naissance = "",$metier = "",$prenom = "" ,$role = "")
    {
        $this->nom = $nom;
        $this->role = $role;
        $this->prenom = $prenom;
    }
}
?>