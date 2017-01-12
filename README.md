# Projet M1 Big Data

Projet Web des Master 1 Big Data ISEN 2016/2017

## Installation

```bash
sudo apt-get install php7.0 php7.0-xml
wget https://getcomposer.org/installer
php installer
rm installer
php composer.phar install
```

## Configuration

 Dans le future il sera nécessaire de renseigner correctement le fichier ./app/config/parameters.yml.
 
 Voici un exemple de configuration :
```yaml
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: YourDatabaseName
    database_user: YourDatabaseUser
    database_password: YourDatabasePassword
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: ASecretKey

```

  Par la suite, il va falloir importer les entités Doctrine dans la BDD à l'aide de la commande suivante : 
```bash
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```
## Execution

```bash
php bin/console server:start
```
   Le site Web sera alors accessible via [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
