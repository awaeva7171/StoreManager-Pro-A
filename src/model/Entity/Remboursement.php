<?php
class Remboursement {
    private int $id;
    private int $detteId;
    private float $montant;
    private string $date;

    public function __construct(int $id, int $detteId, float $montant, string $date) {
        $this->id = $id;
        $this->detteId = $detteId;
        $this->montant = $montant;
        $this->date = $date;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getDetteId(): int {
        return $this->detteId;
    }
    public function getMontant(): float {
        return $this->montant;
    }
    public function getDate(): string {
        return $this->date;
    }

}