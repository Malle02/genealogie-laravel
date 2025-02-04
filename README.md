# 🚀 Projet Laravel - Généalogie

## 📌 Description
Ce projet est une application de généalogie permettant :
- D'ajouter et gérer des personnes et leurs relations familiales.
- D'envoyer des invitations pour rejoindre une fiche familiale.
- De proposer des modifications validées par une communauté.
- De calculer efficacement le degré de parenté entre deux individus.

## 📦 Installation

### 1️⃣ Cloner le projet
```sh
git clone https://github.com/Malle02/genealogie-laravel.git
cd genealogie-laravel
```

### 2️⃣ Installer les dépendances
```sh
composer install
npm install && npm run dev
```

### 3️⃣ Configurer Laravel
```sh
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Configurer la base de données
- Modifier `.env` pour configurer la connexion à MySQL :
```env
DB_DATABASE=genealogie_db
DB_USERNAME=root
DB_PASSWORD=
```

- Exécuter les migrations :
```sh
php artisan migrate --seed
```

### 5️⃣ Lancer le serveur
```sh
php artisan serve
```

Le site est accessible sur **[http://127.0.0.1:8000](http://127.0.0.1:8000)**.

## 🚀 Fonctionnalités

✔️ **Gestion des personnes et relations familiales**  
✔️ **Système d’invitation et d’acquisition de fiche familiale**  
✔️ **Propositions et validation communautaire des modifications**  
✔️ **Calcul optimisé du degré de parenté**  
✔️ **Tests unitaires et fonctionnels avec Pest**  

## 🛠 Tester l'application

Lancer les tests Pest :
```sh
php artisan test
```

## 📝 Schéma de la base de données

📌 **Voir le schéma ici :**  
🔗 dbdiagram.io =>  https://dbdiagram.io/d/67a28947263d6cf9a009f83f

## 📧 Contact
Mallé TRAORE 
📌 LinkedIn => https://www.linkedin.com/in/malle-traore-20001102d
📌 GitHub => https://github.com/Malle02
