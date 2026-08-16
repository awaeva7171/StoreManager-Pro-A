<?php
class Approvisionnement {
    private int $id;
    private int $fournisseurId;
    private int $utilisateurId;
    private string $date;
    private float $montantTotal;
    private string $statut;

    public function __construct(int $id, int $fournisseurId, int $utilisateurId, string $date, float $montantTotal, string $statut) {
        $this->id = $id;
        $this->fournisseurId = $fournisseurId;
        $this->utilisateurId = $utilisateurId;
        $this->date = $date;
        $this->montantTotal = $montantTotal;
        $this->statut = $statut;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getFournisseurId(): int {
        return $this->fournisseurId;
    }
    public function getUtilisateurId(): int {
        return $this->utilisateurId;
    }
    public function getDate(): string {
        return $this->date;
    }
    public function getMontantTotal(): float {
        return $this->montantTotal;
    }
    public function getStatut(): string {
        return $this->statut;
    }

    public function approRecu() : bool { 
        return $this->statut == 'RECU';
    }
}