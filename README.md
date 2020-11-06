# CigRecords

## Configuration

### Créer le fichier de configuration

#### Copier le fichier .env.local en .env
```bash
cp .env.local .env
```

#### Modifier les variables dans le fichier .env

```dotenv
DATABASE_NAME=ipssi_cig-records
MYSQL_USER=root
MYSQL_PASSWORD=
MYSQL_HOST=127.0.0.1
MYSQL_PORT=3307
```

Si vous utilisez MySQL, utilisez le port `3306`.
Si vous utilisez MariaDB, utilisez le port `3307`.


### Créer la base de données

```bash
php bin/console doctrine:database:create
```

### Executer les migrations 

```bash
php bin/console doctrine:migrations:execute
```

## Démarrer un serveur local

```bash
php -S localhost:8000 -t public
```