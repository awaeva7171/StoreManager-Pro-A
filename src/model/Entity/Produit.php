<?php
class Produit {
    private int $id;  
    private string $nom;  
    private ?string $description;  
    private ?string $categorie;  
    private float $prix ; 
    private int $seuil_alerte ;

    
    public function __construct(int $id,string $nom,string $description,?string $categorie,float $prix,int $seuil_alerte)  {
    
    $this->id = $id;
    $this->nom = $nom;
    $this->description = $description;
    $this->categorie = $categorie;
    $this->prix = $prix;
    $this->seuil_alerte = $seuil_alerte;   
    }

    public function getId() : int {
        return $this->id ;
    }
    public function getNom(): string {
        return $this->nom;
    }
    public function getDescription(): string {
        return $this->description;
    }
    public function getCategorie(): string {
        return $this->categorie;
    }

    public function getPrix(): float {
        return $this->prix;
    }
     public function getSeuil_alerte(): int {
        return $this->seuil_alerte;
    }

   
}




