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
#### Commit [hash après ton commit] — fix(database): distinction commande/livraison et justification d'ecart
- **Ce qui a été fait** : Correction de `LigneApprovisionnement` (séparation quantité/prix commandés vs livrés) et ajout du champ `justification` dans `LigneInventaire`.
- **Pourquoi ces choix** :
  - `LigneApprovisionnement` avait à l'origine un seul champ `quantite` et un seul `prix_unitaire`, ce qui supposait que la commande et la livraison étaient toujours identiques. Or en réalité, la quantité livrée peut différer de la quantité commandée (rupture partielle chez le fournisseur), et le prix facturé à la livraison peut différer du prix négocié à la commande. J'ai donc séparé en `quantite_commandee`/`quantite_livree` et `prix_unitaire_commande`/`prix_unitaire_livre`, ces deux derniers champs restant nullable tant que la livraison n'est pas encore reçue.
  - `LigneInventaire` ne contenait pas de champ pour justifier un écart, alors que mon diagramme Use Case Inventaire (déjà commité) prévoit explicitement `Signaler un écart d'inventaire` → include → `Insérer commentaire / justification`. Le schéma SQL n'était donc pas cohérent avec le Use Case. J'ai ajouté `justification TEXT`, nullable puisqu'elle n'est pertinente que si un écart est détecté.
- **Difficultés / Obstacles** : Cette correction vient d'une relecture croisée entre mon diagramme Use Case et mon schéma SQL — j'ai réalisé que les deux n'étaient pas alignés. Ça m'a fait comprendre l'importance de vérifier la cohérence entre les différents livrables UML avant de passer à l'implémentation.

## 2. Autopsie de 3 Méthodes Clés (Indispensable pour l'oral)
[à compléter en Phase 3]
