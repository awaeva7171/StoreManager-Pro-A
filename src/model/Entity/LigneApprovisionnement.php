<?php
class LigneApprovisionnement {
    private int $id;
    private int $approvisionnementId;
    private int $produitId;
    private int $quantiteCommandee;
    private ?int $quantiteLivree;
    private float $prixUnitaireCommande;
    private ?float $prixUnitaireLivre;
    private float $sousTotal;

    public function __construct(int $id, int $approvisionnementId, int $produitId, int $quantiteCommandee, ?int $quantiteLivree, float $prixUnitaireCommande, ?float $prixUnitaireLivre, float $sousTotal) {
        $this->id = $id;
        $this->approvisionnementId = $approvisionnementId;
        $this->produitId = $produitId;
        $this->quantiteCommandee = $quantiteCommandee;
        $this->quantiteLivree = $quantiteLivree;
        $this->prixUnitaireCommande = $prixUnitaireCommande;
        $this->prixUnitaireLivre = $prixUnitaireLivre;
        $this->sousTotal = $sousTotal;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getApprovisionnementId(): int {
        return $this->approvisionnementId;
    }
    public function getProduitId(): int {
        return $this->produitId;
    }
    public function getQuantiteCommandee(): int {
        return $this->quantiteCommandee;
    }
    public function getQuantiteLivree(): ?int {
        return $this->quantiteLivree;
    }
    public function getPrixUnitaireCommande(): float {
        return $this->prixUnitaireCommande;
    }
    public function getPrixUnitaireLivre(): ?float {
        return $this->prixUnitaireLivre;
    }
    public function getSousTotal(): float {
        return $this->sousTotal;
    }

    public function quantiteConforme(): bool {
    if ($this->quantiteLivree === null) {
        return false;
    }
    return $this->quantiteLivree === $this->quantiteCommandee;
}

}