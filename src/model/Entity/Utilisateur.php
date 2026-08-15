<?php

class Utilisateur{

    private int $id;
    private string $nom;
    private string $prenom;
    private string  $email;
    private string  $motDePasse;
    private string  $role;

public function __construct(int $id,string $nom,string $prenom,string $email,string $motDePasse,string $role){


    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->email = $email;
    $this->motDePasse = $motDePasse;
    $this->role = $role;
}

public function getId() : int {
        return $this->id ;
    }
    public function getNom(): string {
        return $this->nom;
    }
    public function getPrenom(): ?string {
        return $this->prenom;
    }
    public function getEmail(): ?string {
        return $this->email;
    }

    public function getMotDePasse(): string {
        return $this->motDePasse;
    }
     public function getRole(): string {
        return $this->role;
    }
    

    public function verifieRole(string $roleAVerifier) : bool {
        if ( $roleAVerifier == $this->role  ){
            return true;
        }
        else return false;
    }

}





CREATE TABLE utilisateurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('Admin', 'Vente', 'Stock', 'Inventaire'))
);