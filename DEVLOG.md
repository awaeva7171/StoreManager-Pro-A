# 📓 Journal de Développement (DEVLOG)
**Nom & Prénom** : awa sall
**Projet** : StoreManager Pro 

---

## 1. Suivi Chronologique des Phases

### 🌃 [Phase 1] : Conception UML

#### Commit `f5ec091` — docs(uml): use case Admin et Chargé de Vente
- **Ce qui a été fait** : Diagrammes de cas d'utilisation pour les acteurs Admin et Vente.
- **Pourquoi ces choix** : Admin a été modélisé avec accès complet (création/consultation) car il supervise tous les profils. Vente a été limité aux cas d'usage liés à la caisse (création de vente, gestion client) pour refléter son périmètre métier réel.
- **Difficultés / Obstacles** :un peu

#### Commit `0fa9e3a` — docs(uml): use case Chargé de Stock
- **Ce qui a été fait** : Diagramme de cas d'utilisation pour l'acteur Stock, avec extend vers les formulaires de création (Ajouter produit, Créer client, Créer fournisseur).
- **Pourquoi ces choix** : Stock a des droits de création contrairement à Inventaire — cette distinction reflète que Stock gère l'approvisionnement quotidien tandis qu'Inventaire ne fait que consulter et compter.
- **Difficultés / Obstacles** : pas tellement

#### Commit `a99f3c0` — docs(uml): use case Inventaire
- **Ce qui a été fait** : Diagramme de cas d'utilisation pour l'acteur Inventaire, en lecture seule, avec le cas d'usage « Effectuer un comptage de stock ».
- **Pourquoi ces choix** : Contrairement à Stock, Inventaire n'a aucun bouton de création — seulement 4 cas d'usage primaires de consultation, plus les extend recherche/comptage. Le comptage inclut la comparaison stock théorique vs quantité comptée, et signale un écart uniquement si détecté (extend optionnel).
- **Difficultés / Obstacles** : beaucoup meme

#### Commit `aa346c4` — docs(uml): ajout des diagrammes de cas d'utilisation et de classes POO
- **Ce qui a été fait** : Diagramme de classes modélisant Utilisateur, Produit, Stock, Client, Fournisseur, Vente, LigneVente, Paiement, Dette, Remboursement, Approvisionnement, LigneApprovisionnement, Inventaire, LigneInventaire.
- **Pourquoi ces choix** :
  - `role` typé en énumération (`Admin`, `Vente`, `Stock`, `Inventaire`) plutôt qu'en texte libre, pour anticiper le contrôle d'accès de l'AuthManager (Phase 3).
  - `Vente --> Paiement` en cardinalité `0..*` (et non `1..*`) : j'avais d'abord mis `1..*` (obligation d'au moins un paiement), mais je me suis rendu compte que c'était incohérent avec l'existence de `Dette` — une vente peut très bien n'avoir aucun paiement immédiat si elle part en dette.
  - `Stock` séparé de `Produit` pour permettre le suivi de `dateMiseAJour` indépendamment.
  - Association directe `Fournisseur --> Produit` ajoutée pour un accès rapide "produits par fournisseur" sans passer par les lignes d'approvisionnement.
- **Difficultés / Obstacles** : beaucoup meme

---

## 2. Autopsie de 3 Méthodes Clés (Indispensable pour l'oral)
[à compléter en Phase 3]
