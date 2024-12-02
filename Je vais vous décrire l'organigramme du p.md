Je vais vous décrire l'organigramme du projet sous forme de texte :

### Organigramme du Projet

1. **Accueil (Tableau de Bord)**
   - Vue d'ensemble des fonctionnalités
   - Accès rapide aux sections principales

2. **Authentification**
   - **Login**
     - Formulaire de connexion pour l'admin
   - **Signup**
     - Formulaire d'inscription pour créer un compte admin

3. **Gestion des Véhicules**
   - Afficher la liste des véhicules
   - Ajouter/modifier/supprimer des véhicules

4. **Gestion des Documents**
   - Afficher les documents par véhicule
   - Ajouter des documents (avec téléchargement de photo)
   - Vérifier les dates d'expiration

5. **Vérifications Journalières**
   - Enregistrer une vérification pour un véhicule
   - Afficher l'historique des vérifications

6. **Notifications**
   - Alerter sur les documents proches de l'expiration
   - Filtrer par type de document

### Base de Données

- **Tables** :
  - `admins`
  - `vehicules`
  - `documents`
  - `verifications`

### Flux de Travail

1. L'admin se connecte via la page de login.
2. Accède au tableau de bord pour gérer les véhicules et documents.
3. Ajoute des vérifications journalières.
4. Consulte les notifications pour gérer les documents expirés.

Cet organigramme vous aide à structurer le développement et l'implémentation des différentes fonctionnalités du projet.