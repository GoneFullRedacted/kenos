# Projet Kelos

Le projet Kelos est un réseau social fictif d'entreprise pour la franchise de chocolaterie Kelos. 

## Installation

Create a `.env.local` file inside the root directory with the following information customized to your needs:
```ini
APP_ENV=dev
APP_SECRET=app_secret

DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"

Run `composer install` inside the root directory, this will create a vendor directory with the dependencies.

Run `php bin/console doctrine:database:create` to create the database.

Run `php bin/console doctrine:migrations:migrate` to update the database.

## Définition des normes de synthaxe et organisationnelles du projet

### Normes synthaxique

- Les indentations sont faites via des tabulations
- Double saut de ligne entre les méthodes
- Saut de ligne entre chaque argument
- Ligne unique pour `}` de fermeture
- Priviligié guillemet simple, double si variable (php).
- camelCase pour php/js
- kebab-case pour html/css

### Répartition des tâches pour le projet Kelos.

Sébastien : 

- Super admin
- Profile
- Interface connexion
- Affichage liste utilisateur
- Affichage des chocolateries

Lucas : 

- Admin
- Posts
- Affichage news
- Affichage catégories