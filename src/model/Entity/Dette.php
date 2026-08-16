<?php
class Dette {
    private int $id;
    private int $venteId;
    private int $clientId;
    private float $montant;
    private float $montantRestant;
    private string $date;
    private string $statut;

    public function __construct(int $id, int $venteId, int $clientId, float $montant, float $montantRestant, string $date, string $statut) {
        $this->id = $id;
        $this->venteId = $venteId;
        $this->clientId = $clientId;
        $this->montant = $montant;
        $this->montantRestant = $montantRestant;
        $this->date = $date;
        $this->statut = $statut;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getVenteId(): int {
        return $this->venteId;
    }
    public function getClientId(): int {
        return $this->clientId;
    }
    public function getMontant(): float {
        return $this->montant;
    }
    public function getMontantRestant(): float {
        return $this->montantRestant;
    }
    public function getDate(): string {
        return $this->date;
    }
    public function getStatut(): string {
        return $this->statut;
    }

    public function estEnCours(): bool {
    return $this->statut === 'EN_COURS';
  }

}