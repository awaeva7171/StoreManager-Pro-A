
CREATE TABLE utilisateurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('Admin', 'Vente', 'Stock', 'Inventaire'))
);

CREATE TABLE produits (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    categorie VARCHAR(100),
    prix NUMERIC(10,2) NOT NULL CHECK (prix >= 0),
    seuil_alerte INTEGER NOT NULL DEFAULT 0 CHECK (seuil_alerte >= 0)
);

CREATE TABLE stocks (
    id SERIAL PRIMARY KEY,
    produit_id INTEGER NOT NULL UNIQUE REFERENCES produits(id) ON DELETE CASCADE,
    quantite_disponible INTEGER NOT NULL DEFAULT 0 CHECK (quantite_disponible >= 0),
    date_mise_a_jour TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clients (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    email VARCHAR(150),
    adresse TEXT
);

CREATE TABLE fournisseurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    telephone VARCHAR(20),
    email VARCHAR(150),
    adresse TEXT
);

ALTER TABLE produits ADD COLUMN fournisseur_id INTEGER REFERENCES fournisseurs(id) ON DELETE SET NULL;

CREATE TABLE ventes (
    id SERIAL PRIMARY KEY,
    client_id INTEGER REFERENCES clients(id) ON DELETE SET NULL,
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateurs(id),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total NUMERIC(10,2) NOT NULL DEFAULT 0 CHECK (montant_total >= 0),
    statut VARCHAR(20) NOT NULL CHECK (statut IN ('EN_COURS', 'VALIDEE', 'ANNULEE'))
);

CREATE TABLE lignes_ventes (
    id SERIAL PRIMARY KEY,
    vente_id INTEGER NOT NULL REFERENCES ventes(id) ON DELETE CASCADE,
    produit_id INTEGER NOT NULL REFERENCES produits(id),
    quantite INTEGER NOT NULL CHECK (quantite > 0),
    prix_unitaire NUMERIC(10,2) NOT NULL CHECK (prix_unitaire >= 0),
    sous_total NUMERIC(10,2) NOT NULL CHECK (sous_total >= 0)
);

CREATE TABLE paiements (
    id SERIAL PRIMARY KEY,
    vente_id INTEGER NOT NULL REFERENCES ventes(id) ON DELETE CASCADE,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant NUMERIC(10,2) NOT NULL CHECK (montant > 0),
    mode_paiement VARCHAR(30) NOT NULL,
    statut VARCHAR(20) NOT NULL CHECK (statut IN ('VALIDE', 'ANNULE'))
);

CREATE TABLE dettes (
    id SERIAL PRIMARY KEY,
    vente_id INTEGER UNIQUE NOT NULL REFERENCES ventes(id) ON DELETE CASCADE,
    client_id INTEGER NOT NULL REFERENCES clients(id),
    montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0),
    montant_restant NUMERIC(10,2) NOT NULL CHECK (montant_restant >= 0),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut VARCHAR(20) NOT NULL CHECK (statut IN ('EN_COURS', 'SOLDEE'))
);

CREATE TABLE remboursements (
    id SERIAL PRIMARY KEY,
    dette_id INTEGER NOT NULL REFERENCES dettes(id) ON DELETE CASCADE,
    montant NUMERIC(10,2) NOT NULL CHECK (montant > 0),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE approvisionnements (
    id SERIAL PRIMARY KEY,
    fournisseur_id INTEGER NOT NULL REFERENCES fournisseurs(id),
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateurs(id),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montant_total NUMERIC(10,2) NOT NULL DEFAULT 0 CHECK (montant_total >= 0),
    statut VARCHAR(20) NOT NULL CHECK (statut IN ('EN_ATTENTE', 'RECU'))
);

CREATE TABLE lignes_approvisionnements (
    id SERIAL PRIMARY KEY,
    approvisionnement_id INTEGER NOT NULL REFERENCES approvisionnements(id) ON DELETE CASCADE,
    produit_id INTEGER NOT NULL REFERENCES produits(id),
    quantite_commandee INTEGER NOT NULL CHECK (quantite_commandee > 0),
    quantite_livree INTEGER CHECK (quantite_livree >= 0),
    prix_unitaire_commande NUMERIC(10,2) NOT NULL CHECK (prix_unitaire_commande >= 0),
    prix_unitaire_livre NUMERIC(10,2) CHECK (prix_unitaire_livre >= 0),
    sous_total NUMERIC(10,2) NOT NULL CHECK (sous_total >= 0)
);

CREATE TABLE inventaires (
    id SERIAL PRIMARY KEY,
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateurs(id),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut VARCHAR(20) NOT NULL CHECK (statut IN ('EN_COURS', 'TERMINE'))
);

CREATE TABLE lignes_inventaires (
    id SERIAL PRIMARY KEY,
    inventaire_id INTEGER NOT NULL REFERENCES inventaires(id) ON DELETE CASCADE,
    produit_id INTEGER NOT NULL REFERENCES produits(id),
    quantite_theorique INTEGER NOT NULL CHECK (quantite_theorique >= 0),
    quantite_reelle INTEGER NOT NULL CHECK (quantite_reelle >= 0),
    ecart INTEGER NOT NULL DEFAULT 0,
    justification TEXT
);

