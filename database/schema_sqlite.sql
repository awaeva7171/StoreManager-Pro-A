
CREATE TABLE utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    mot_de_passe TEXT NOT NULL,
    role TEXT NOT NULL CHECK (role IN ('Admin', 'Vente', 'Stock', 'Inventaire'))
);

CREATE TABLE fournisseurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT,
    email TEXT,
    adresse TEXT
);

CREATE TABLE produits (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    description TEXT,
    categorie TEXT,
    prix REAL NOT NULL CHECK (prix >= 0),
    seuil_alerte INTEGER NOT NULL DEFAULT 0 CHECK (seuil_alerte >= 0),
    fournisseur_id INTEGER REFERENCES fournisseurs(id) ON DELETE SET NULL
);

CREATE TABLE stocks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    produit_id INTEGER NOT NULL UNIQUE REFERENCES produits(id) ON DELETE CASCADE,
    quantite_disponible INTEGER NOT NULL DEFAULT 0 CHECK (quantite_disponible >= 0),
    date_mise_a_jour TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    telephone TEXT,
    email TEXT,
    adresse TEXT
);

CREATE TABLE ventes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER REFERENCES clients(id) ON DELETE SET NULL,
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateurs(id),
    date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total REAL NOT NULL DEFAULT 0 CHECK (montant_total >= 0),
    statut TEXT NOT NULL CHECK (statut IN ('EN_COURS', 'VALIDEE', 'ANNULEE'))
);

CREATE TABLE lignes_ventes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    vente_id INTEGER NOT NULL REFERENCES ventes(id) ON DELETE CASCADE,
    produit_id INTEGER NOT NULL REFERENCES produits(id),
    quantite INTEGER NOT NULL CHECK (quantite > 0),
    prix_unitaire REAL NOT NULL CHECK (prix_unitaire >= 0),
    sous_total REAL NOT NULL CHECK (sous_total >= 0)
);

CREATE TABLE paiements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    vente_id INTEGER NOT NULL REFERENCES ventes(id) ON DELETE CASCADE,
    date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant REAL NOT NULL CHECK (montant > 0),
    mode_paiement TEXT NOT NULL,
    statut TEXT NOT NULL CHECK (statut IN ('VALIDE', 'ANNULE'))
);

CREATE TABLE dettes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    vente_id INTEGER UNIQUE NOT NULL REFERENCES ventes(id) ON DELETE CASCADE,
    client_id INTEGER NOT NULL REFERENCES clients(id),
    montant REAL NOT NULL CHECK (montant >= 0),
    montant_restant REAL NOT NULL CHECK (montant_restant >= 0),
    date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut TEXT NOT NULL CHECK (statut IN ('EN_COURS', 'SOLDEE'))
);

CREATE TABLE remboursements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dette_id INTEGER NOT NULL REFERENCES dettes(id) ON DELETE CASCADE,
    montant REAL NOT NULL CHECK (montant > 0),
    date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE approvisionnements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fournisseur_id INTEGER NOT NULL REFERENCES fournisseurs(id),
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateurs(id),
    date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total REAL NOT NULL DEFAULT 0 CHECK (montant_total >= 0),
    statut TEXT NOT NULL CHECK (statut IN ('EN_ATTENTE', 'RECU'))
);

CREATE TABLE lignes_approvisionnements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    approvisionnement_id INTEGER NOT NULL REFERENCES approvisionnements(id) ON DELETE CASCADE,
    produit_id INTEGER NOT NULL REFERENCES produits(id),
    quantite INTEGER NOT NULL CHECK (quantite > 0),
    prix_unitaire REAL NOT NULL CHECK (prix_unitaire >= 0),
    sous_total REAL NOT NULL CHECK (sous_total >= 0)
);

CREATE TABLE inventaires (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateurs(id),
    date TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut TEXT NOT NULL CHECK (statut IN ('EN_COURS', 'TERMINE'))
);

CREATE TABLE lignes_inventaires (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    inventaire_id INTEGER NOT NULL REFERENCES inventaires(id) ON DELETE CASCADE,
    produit_id INTEGER NOT NULL REFERENCES produits(id),
    quantite_theorique INTEGER NOT NULL CHECK (quantite_theorique >= 0),
    quantite_reelle INTEGER NOT NULL CHECK (quantite_reelle >= 0),
    ecart INTEGER NOT NULL DEFAULT 0
);

