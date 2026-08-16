<?php
class Vente {
    private int $id;
    private ?int $clientId;
    private int $utilisateurId;
    private string $date;
    private float $montantTotal;
    private string $statut;

    public function __construct(int $id, ?int $clientId, int $utilisateurId, string $date, float $montantTotal, string $statut) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->utilisateurId = $utilisateurId;
        $this->date = $date;
        $this->montantTotal = $montantTotal;
        $this->statut = $statut;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getClientId(): ?int {
        return $this->clientId;
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

    public function estValidee(): bool {
    return $this->statut === 'VALIDEE';
    }

}