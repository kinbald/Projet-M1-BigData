# Projet M1 Big Data

Projet Web des Master 1 Big Data ISEN 2016/2017

## Installation

```bash
sudo apt-get install php7.0 php7.0-xml
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'aa96f26c2b67226a324c27919f1eb05f21c248b987e6195cad9690d5c1ff713d53020a02ac8c217dbf90a7eacc9d141d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
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
## Execution

```bash
./bin/console server:start
```
   Le site Web sera alors accessible via [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
