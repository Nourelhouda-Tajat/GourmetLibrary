# GourmetLibrary API - Gestion de Médiathèque Culinaire

## Présentation du Projet
Ce projet est une API REST sécurisée développée dans le cadre d'un brief de gestion de collection de livres de cuisine. L'objectif est de permettre aux passionnés de cuisine (Gourmands) de trouver l'inspiration et au Chef Bibliothécaire de gérer son stock efficacement.

##  Fonctionnalités Clés

###  Pour les Utilisateurs (Gourmands)
* **Recherche Multi-critères :** Par titre, auteur (chef) ou catégorie.
* **Filtres Intelligents :** Consultation par catégorie spécifique (ex: Pâtisserie).
* **Découverte :** Accès direct aux 5 derniers livres ajoutés et aux ouvrages les plus populaires.

### Pour l'Administrateur (Chef Bibliothécaire)
* **Gestion Totale (CRUD) :** Ajout, modification et suppression de livres et catégories.
* **Suivi de l'état :** Liste des livres dégradés (statut `damaged`) pour maintenance.
* **Analyse de la collection :** Statistiques sur le nombre de livres par catégorie.

## 🛠️ Stack Technique
* **Framework :** Laravel 11
* **Authentification :** Laravel Sanctum (Bearer Tokens)
* **Base de données :** MySQL
* **Outils :** Eloquent ORM, Middlewares personnalisés, Seeders.