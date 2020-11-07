# CigRecords

## Installation

### Installation des dépendances

```bash
composer install
yarn
```

ou si vous préferez NPM :

```
composer install
npm install
```

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

### Construire les styles & scripts

```bash
yarn encore prod
```

ou si vous préferez le mode developpeur : 

```bash
yarn encore dev
```

## Démarrer un serveur local

```bash
symfony serve
```

ou via PHP-CLI :

```bash
php -S localhost:8000 -t public
```


## Pages accessibles

Vous pouvez accedez aux pages suivantes :

- Page d'accueil : `/`
- Administration : `/admin`
- Administration des utilisateurs (administrateur) : `/admin/user`
- Administration des albums : `/admin/album`
- Administration des artistes : `/admin/artist`
- Administration des articles : `/admin/article`