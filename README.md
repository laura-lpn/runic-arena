<img src="public/images/favicon.ico" width="100">

# Runic Arena

Le projet est une plateforme communautaire pour un jeu de cartes à collectionner (TCG) accessible via navigateur. Ce projet permet aux joueurs de proposer des nouvelles cartes à inclure dans le jeu.

L'objectif principal est de mettre en place un générateur de cartes convivial, comprenant une interface publique pour la présentation du projet, un espace utilisateur privé pour créer et gérer ses cartes, ainsi qu'un espace administrateur pour superviser l'ensemble des activités sur la plateforme.

---

## Fonctionnalités

1. Gestion des cartes

    Les cartes sont caractérisées par :
    - `Nom` : Le nom de l'invocation.
    - `Type` : Deux options possibles - "Chaos" ou "Halo".
    - `Classe` : Une des cinq classes disponibles - Mage, Soigneur, Guerrier, Archer, Assassin
    - `Puissance d'attaque` : Une valeur numérique représentant la puissance d'attaque de l'invocation.

2. Plateforme publique

    - Landing page : Une page publique présentant le projet, incluant :
    - Une description du projet.
    - Un lien fictif vers la campagne Kickstarter.
    - Une liste des 5 dernières cartes proposées par la communauté.

3. Espace utilisateur privé

    - Authentification : Les utilisateurs doivent créer un compte et s'authentifier.
    - Gestion des cartes : Chaque utilisateur peut créer, modifier, supprimer et visualiser ses propres propositions de cartes (CRUD).

4. Espace administrateur

    - Tableau de bord : Une page admin proposant des statistiques sous forme de visualisations interactives :
      - Nombre total de cartes générées.
      - Répartition des cartes par type (diagramme circulaire).
      - Répartition des cartes par classe (diagramme circulaire).
    - Gestion complète : l'administrateur peut accéder à l'ensemble des cartes proposées pour les gérer.

5. API publique

    - Endpoint : Un endpoint REST API accessible à l'URL /api/cards pour retourner toutes les cartes en format JSON.

---

## Installation

1. Installer les dépendances backend :

    ```bash
    composer install
    symfony console importmap:install
    ```

2. Configurer l'environnement :

    Créer un fichier `.env.local` en copiant le contenu du fichier `.env` et en configurant les variables d'environnement.

    ```env
    ###> doctrine/doctrine-bundle ###
    DATABASE_URL="mysql://user:password@127.0.0.1:3307/runic_arena?serverVersion=10.10.2-MariaDB&charset=utf8mb4"
    ###< doctrine/doctrine-bundle ###
    ```

3. Créer la base de données :

    ```bash
    symfony console doctrine:database:create
    ```

4. Exécuter les migrations :

    ```bash
    symfony console doctrine:migrations:migrate
    ```

5. Build tailwindcss :

    ```bash
    symfony console tailwindcss:build
    ```

6. Lancez le serveur de développement :

    ```bash
    symfony serve -d
    ```

---

## Aperçu du projet

### Page d'accueil

<img src="public/images/screenshots/home.png" width="40%">

### Page de connexion

<img src="public/images/screenshots/login.png" width="40%">

### Page d'inscription

<img src="public/images/screenshots/register.png" width="40%">

### Page de création de carte

<img src="public/images/screenshots/add.png" width="40%">

### Espace utilisateur

<img src="public/images/screenshots/cards.png" width="40%">

### Espace administrateur

<img src="public/images/screenshots/dashboard.png" width="40%">
