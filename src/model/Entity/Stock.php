<?php
class Stock {
    private int $id;
    private int $produitId;
    private int $quantiteDisponible;
    private string $dateMiseAJour;

    public function __construct(int $id, int $produitId, int $quantiteDisponible, string $dateMiseAJour) {
        $this->id = $id;
        $this->produitId = $produitId;
        $this->quantiteDisponible = $quantiteDisponible;
        $this->dateMiseAJour = $dateMiseAJour;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getProduitId(): int {
        return $this->produitId;
    }
    public function getQuantiteDisponible(): int {
        return $this->quantiteDisponible;
    }
    public function getDateMiseAJour(): string {
        return $this->dateMiseAJour;
    }

    public function estDisponible(int $quantiteDemandee): bool{
    return $this->quantiteDisponible >= $quantiteDemandee;
}
}