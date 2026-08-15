<?php
class Produit {
    private int $id;  
    private string $nom;  
    private ?string $description;  
    private ?string $categorie;  
    private float $prix ; 
    private int $seuilAlerte ;

    
    public function __construct(string $nom,string $description,?string $categorie,float $prix,int $seuilAlerte)  {
    
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
    public function getDescription(): ?string {
        return $this->description;
    }
    public function getCategorie(): ?string {
        return $this->categorie;
    }

    public function getPrix(): float {
        return $this->prix;
    }
     public function getSeuilAlerte(): int {
        return $this->seuilAlerte;
    }

     public function estEnAlerte(int $quantiteActuelle): bool {
        return $quantiteActuelle <= $this->seuilAlerte;
    }
    
   
}




