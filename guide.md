# Supermarche

Application de gestion de supermarche developpee avec **CodeIgniter 4** (PHP).  
Elle permet de gerer des caisses, enregistrer des achats de produits, et cloturer les ventes par caisse.

---

## Prerequis

| Logiciel | Version minimale |
|----------|-----------------|
| PHP      | 8.1+            |
| Composer | 2.x             |
| SQLite   | 3.x (extension `pdo_sqlite` activee dans `php.ini`) |

> **Note** : Assurez-vous que les extensions PHP suivantes sont activees dans votre `php.ini` :
> - `intl`
> - `mbstring`
> - `pdo_sqlite`
> - `json`

---

## Installation

### 1. Cloner le depot

```bash
git clone <URL_DU_DEPOT>
cd supermarche
```

### 2. Installer les dependances PHP

```bash
composer install
```

### 3. Configurer l'environnement

Copiez le fichier `.env` d'exemple et ajustez-le :

```bash
cp env .env
```

Editez le fichier `.env` et assurez-vous que les lignes suivantes sont presentes :

```ini
CI_ENVIRONMENT = development

database.default.DBDriver = SQLite3
database.default.database = writable/database.db
```

### 4. Creer la base de donnees

Executez le script SQL pour creer les tables et inserer les donnees initiales :

```bash
php spark db:query "$(cat Data.sql)"
```

**Ou manuellement** avec l'outil `sqlite3` :

```bash
sqlite3 writable/database.db < Data.sql
```

> **Important** : Le fichier `writable/database.db` doit etre accessible en lecture/ecriture par le serveur web.

### 5. Verifier les permissions

```bash
chmod -R 775 writable/
```

Sur Windows, assurez-vous que le dossier `writable/` est accessible en ecriture.

---

## Lancer le serveur de developpement

```bash
php spark serve
```

L'application sera accessible a l'adresse :

```
http://localhost:8080
```

---

## Utilisation

### Connexion

Rendez-vous sur `http://localhost:8080/login` et connectez-vous avec l'un des comptes par defaut :

| Nom d'utilisateur | Mot de passe |
|-------------------|-------------|
| `admin`           | `admin`     |
| `caissier1`       | `1234`      |

### Flux de travail

1. **Connexion** → Entrez vos identifiants sur la page de login.
2. **Selection de caisse** → Choisissez une caisse parmi celles disponibles.
3. **Saisie des achats** → Selectionnez un produit, indiquez la quantite, puis cliquez sur « Enregistrer l'achat ».
4. **Cloture** → Cliquez sur « Cloturer achat » pour finaliser la vente et passer au client suivant.
5. **Deconnexion** → Utilisez les liens dans la barre de navigation pour changer de caisse ou vous deconnecter.

---

## Structure du projet

```
supermarche/
├── app/
│   ├── Config/
│   │   └── Routes.php          # Definition des routes
│   ├── Controllers/
│   │   └── CaisseController.php # Logique metier principale
│   ├── Models/
│   │   ├── AchatModel.php       # Modele des achats
│   │   ├── CaisseModel.php      # Modele des caisses
│   │   ├── ProduitModel.php     # Modele des produits
│   │   └── UtilisateurModel.php # Modele des utilisateurs
│   └── Views/
│       ├── login.php            # Page de connexion
│       ├── accueil.php          # Selection de caisse
│       └── achats.php           # Saisie et liste des achats
├── public/
│   ├── css/
│   │   └── style.css            # Feuille de style globale
│   └── index.php                # Point d'entree
├── Data.sql                     # Script de creation de la base
├── composer.json
└── README.md
```

---

## Routes

| Methode | URL               | Action                        |
|---------|-------------------|-------------------------------|
| GET     | `/login`          | Afficher le formulaire de login |
| POST    | `/login`          | Authentifier l'utilisateur    |
| GET     | `/`               | Page d'accueil (choix caisse) |
| POST    | `/select-caisse`  | Selectionner une caisse       |
| GET     | `/achats`         | Page de saisie des achats     |
| POST    | `/achats/add`     | Ajouter un achat              |
| POST    | `/achats/cloturer`| Cloturer les achats en cours  |
| GET     | `/logout`         | Changer de caisse             |
| GET     | `/full-logout`    | Deconnexion complete          |

---

## Licence

Voir le fichier [LICENSE](LICENSE).
