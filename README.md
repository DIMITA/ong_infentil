# ONG Infentil — Site institutionnel

Site web de l'ONG Infentil (santé infantile au Bénin), construit avec **Laravel 13**, **Filament 4**, **TailwindCSS v4**, **AlpineJS** et **PostgreSQL 16**, déployé via **Docker + Nginx**.

---

## Stack technique

| Couche | Technologie |
|---|---|
| Backend | Laravel 13 / PHP 8.3 |
| Back-office | Filament 4 |
| Frontend | Blade · TailwindCSS v4 · AlpineJS 3 |
| Base de données | PostgreSQL 16 |
| Stockage médias | Cloudflare R2 (compatible S3) |
| Email | Brevo SMTP |
| Paiements | KKiaPay (Afrique de l'Ouest) · Donorbox (international) |
| Serveur web | Nginx 1.27 |
| Conteneurs | Docker + Docker Compose |

---

## Prérequis

- **Docker Engine** ≥ 24 et **Docker Compose** v2 (`docker compose` sans tiret)
- Un domaine avec DNS pointant vers votre serveur
- Comptes créés : Cloudflare R2, Brevo, KKiaPay, Donorbox

---

## Déploiement en production

### 1. Cloner le dépôt

```bash
git clone https://github.com/dimita/ong_infentil.git
cd ong_infentil
```

### 2. Créer et renseigner le fichier `.env`

```bash
cp .env.example .env
```

Éditez `.env` et renseignez **au minimum** :

| Variable | Description |
|---|---|
| `APP_KEY` | Laisser vide — généré à l'étape 3 |
| `APP_URL` | `https://votre-domaine.org` |
| `DB_PASSWORD` | Mot de passe fort pour PostgreSQL |
| `DB_USERNAME` | Utilisateur PostgreSQL (ex. `ong_user`) |
| `DB_DATABASE` | Nom de la base (ex. `ong_infentil`) |
| `AWS_ACCESS_KEY_ID` | Clé R2 |
| `AWS_SECRET_ACCESS_KEY` | Secret R2 |
| `AWS_ENDPOINT` | `https://ACCOUNT_ID.r2.cloudflarestorage.com` |
| `MAIL_USERNAME` | Login Brevo |
| `MAIL_PASSWORD` | Clé API Brevo |
| `KKIAPAY_PUBLIC_KEY` | Clé publique KKiaPay |
| `KKIAPAY_PRIVATE_KEY` | Clé privée KKiaPay |
| `KKIAPAY_SECRET` | Secret webhook KKiaPay |

> **Important** : `DB_HOST` doit rester `db` (nom du service Docker Compose).

### 3. Générer la clé d'application

```bash
docker compose run --rm app php artisan key:generate
```

Cela met à jour `APP_KEY` dans votre `.env`.

### 4. Construire et démarrer les conteneurs

```bash
docker compose up -d --build
```

Au premier démarrage, l'entrypoint :
1. Attend que PostgreSQL soit prêt
2. Exécute `php artisan migrate --force`
3. Met en cache config, routes, vues et composants Filament
4. Démarre PHP-FPM + les 2 workers de queue

### 5. Créer le premier administrateur

```bash
docker compose exec app php artisan make:filament-user
```

Accéder au back-office : `https://votre-domaine.org/admin`

### 6. (Optionnel) Charger les données de démonstration

```bash
docker compose exec app php artisan db:seed
```

---

## HTTPS avec Let's Encrypt (Certbot)

La configuration Nginx fournie écoute sur le port 80. Pour ajouter HTTPS :

### Option A — Nginx Proxy Manager (interface graphique)

Remplacez le service `nginx` dans `docker-compose.yml` par Nginx Proxy Manager et configurez les certificats depuis son interface.

### Option B — Certbot standalone

```bash
# Stopper Nginx pour libérer le port 80
docker compose stop nginx

# Obtenir le certificat
certbot certonly --standalone -d votre-domaine.org -d www.votre-domaine.org

# Mettre à jour docker/nginx/nginx.conf pour écouter sur 443 + redirection 80→443
# Monter les certificats dans le service nginx :
#   - /etc/letsencrypt/live/votre-domaine.org:/etc/letsencrypt/live/votre-domaine.org:ro

docker compose start nginx
```

Exemple de bloc HTTPS à ajouter dans `docker/nginx/nginx.conf` :

```nginx
server {
    listen 80;
    server_name votre-domaine.org www.votre-domaine.org;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name votre-domaine.org www.votre-domaine.org;

    ssl_certificate     /etc/letsencrypt/live/votre-domaine.org/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/votre-domaine.org/privkey.pem;
    ssl_protocols       TLSv1.2 TLSv1.3;
    ssl_ciphers         HIGH:!aNULL:!MD5;

    # ... reste de la config (identique au nginx.conf fourni)
}
```

---

## Opérations courantes

### Voir les logs en temps réel

```bash
# Tous les services
docker compose logs -f

# Un service spécifique
docker compose logs -f app
docker compose logs -f nginx
docker compose logs -f db
```

### Exécuter une commande Artisan

```bash
docker compose exec app php artisan <commande>

# Exemples
docker compose exec app php artisan migrate:status
docker compose exec app php artisan queue:failed
docker compose exec app php artisan cache:clear
```

### Accéder au shell du conteneur

```bash
docker compose exec app bash
docker compose exec db psql -U ong_user -d ong_infentil
```

### Mettre à jour l'application

```bash
git pull origin main

# Rebuild l'image et redémarre
docker compose up -d --build

# Les migrations sont exécutées automatiquement par l'entrypoint
```

### Sauvegarde de la base de données

```bash
docker compose exec db pg_dump -U ong_user ong_infentil \
  | gzip > backup_$(date +%Y%m%d_%H%M%S).sql.gz
```

### Restauration

```bash
gunzip -c backup_20250101_120000.sql.gz \
  | docker compose exec -T db psql -U ong_user -d ong_infentil
```

---

## Architecture des conteneurs

```
┌─────────────────────────────────────────────────────┐
│                    Internet / DNS                    │
└──────────────────────┬──────────────────────────────┘
                       │ :80 / :443
             ┌─────────▼──────────┐
             │      nginx          │  Sert public/ statiquement
             │  (nginx:1.27-alpine)│  Proxy → app:9000 pour PHP
             └─────────┬──────────┘
                       │ FastCGI :9000
     ┌─────────────────▼─────────────────────────┐
     │                  app                        │
     │           (php:8.3-fpm-alpine)              │
     │  • PHP-FPM (20 workers max)                 │
     │  • Queue workers ×2 (supervisord)           │
     │  • Scheduler (service séparé)               │
     └──────────┬────────────────────┬────────────┘
                │                    │
     ┌──────────▼──────┐    ┌────────▼────────────┐
     │       db         │    │    Cloudflare R2     │
     │ (postgres:16)    │    │  (stockage médias)   │
     │  Volume persistant│    │  (service externe)   │
     └──────────────────┘    └─────────────────────┘
```

---

## Variables d'environnement importantes

| Variable | Valeur prod | Notes |
|---|---|---|
| `APP_ENV` | `production` | |
| `APP_DEBUG` | `false` | **Ne jamais mettre `true` en prod** |
| `DB_HOST` | `db` | Nom du service Docker |
| `QUEUE_CONNECTION` | `database` | Les jobs newsletter/media utilisent la queue |
| `CACHE_STORE` | `database` | Pas besoin de Redis |
| `KKIAPAY_SANDBOX` | `false` | Mettre `true` pour les tests |
| `FILESYSTEM_DISK` | `r2` | Les médias vont sur R2 |

---

## Développement local

```bash
# Démarrer la stack
docker compose up -d

# Ou sans Docker (nécessite PHP 8.3 + PostgreSQL local)
cp .env.example .env
# Éditer .env avec DB_HOST=127.0.0.1 et les bons identifiants
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev &
php artisan serve
```

---

## Structure Docker

```
docker/
├── entrypoint.sh          # Script de démarrage (migrate, cache, symlink)
├── nginx/
│   └── nginx.conf         # Config Nginx (vhost Laravel)
├── php/
│   ├── php.ini            # Limites, OPcache, timezone
│   └── www.conf           # Pool PHP-FPM (20 workers, dynamic)
├── postgres/
│   └── init.sql           # Extensions PostgreSQL (uuid-ossp, unaccent, pg_trgm)
└── supervisor/
    └── supervisord.conf   # PHP-FPM + 2 queue workers

Dockerfile                 # Multi-stage : Node (assets) → Composer → PHP-FPM
docker-compose.yml         # Services : db, app, nginx, scheduler
.env.example               # Template de configuration
```
