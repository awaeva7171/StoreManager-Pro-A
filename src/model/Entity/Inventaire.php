<?php
class Inventaire {
    private int $id;
    private int $utilisateurId;
    private string $date;
    private string $statut;

    public function __construct(int $id, int $utilisateurId, string $date, string $statut) {
        $this->id = $id;
        $this->utilisateurId = $utilisateurId;
        $this->date = $date;
        $this->statut = $statut;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getUtilisateurId(): int {
        return $this->utilisateurId;
    }
    public function getDate(): string {
        return $this->date;
    }
    public function getStatut(): string {
        return $this->statut;
    }

    public function QteTheoriVsQteReel(): bool {
    foreach ($this->lignes as $ligne) {
        if ($ligne->getQuantiteTheorique() !== $ligne->getQuantiteReelle()) {
            return true;
        }
    }

    return false;
}

}