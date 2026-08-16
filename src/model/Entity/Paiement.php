<?php
class Paiement {
    private int $id;
    private int $venteId;
    private string $date;
    private float $montant;
    private string $modePaiement;
    private string $statut;

    public function __construct(int $id, int $venteId, string $date, float $montant, string $modePaiement, string $statut) {
        $this->id = $id;
        $this->venteId = $venteId;
        $this->date = $date;
         $this->montant = $montant;
        $this->modePaiement = $modePaiement;
        $this->statut = $statut;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getVenteId(): int {
        return $this->venteId;
     }
    public function getDate(): string {
        return $this->date;
    }
    public function getMontant(): float {
        return $this->montant;
    }
    public function getModePaiement(): string {
        return $this->modePaiement;
    }
    public function getStatut(): string {
        return $this->statut;
    }

    public function estValide(): bool {
    return $this->statut === 'VALIDE';
}
}