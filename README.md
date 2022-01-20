# STI - Projet 2

> Auteurs : Delphine Scherler et Doran Kayoumi
>
> Date : 20.01.2022

Pour exécuter notre projet :

1. Cloner le dossier localement sur votre ordinateur.
2. Démarrer Docker.
3. Ouvrir une fenêtre Git Bash à la racine du projet.
4. Lancer le script suivant dans l’invit Bash : ./docker/install.sh (à faire que la première fois)
5. Accéder à http://localhost:9396/ depuis un navigateur.
6. À tout moment vous pouvez arrêter les containers avec `docker-compose stop` et les redémarrer avec `docker-compose up -d`

## Login

Vous arrivez sur cette page :

<img src="images/login.PNG" alt="login" width="500" />

Deux utilisateurs sont créés au lancement de l'application :

- Un administrateur
  - username : admin
  - password : admin
- Un collaborateur :
  - username : test
  - password : test

Vous pouvez utiliser l'un d'eux pour vous connecter.

## Inbox

Dès que vous êtes connecté vous allez arriver sur la page principale de la messagerie.

Vue par un administrateur :

<img src="images/inbox.PNG" alt="inbox" style="zoom:80%;" />

Vue par un utilisateur :

<img src="images/inbox_2.PNG" alt="inbox_2" style="zoom:80%;" />

Pour la démo, la base de données fournie dans GitHub contient quelques mails.

Depuis cette page vous pouvez :

- Lire, répondre ou supprimer des messages.
- Ecrire un nouveau message.
- Changer votre mot de passe.
- Accéder à la page d'administration, si vous êtes administrateur.
- Vous déconnecter.

## New message / Answer

Voici la page pour écrire un nouveau message :

<img src="images/new_msg.PNG" alt="new_msg" width="350" />

## Read

Cette page permet de lire le corps du message. Mais également de répondre ou de supprimer celui-ci.

<img src="images/read.PNG" alt="read" width="350" />

## Change my password

Cette page permet de changer son mot de passe.

<img src="images/password.PNG" alt="password" width="350" />

## Administration

Cette page est réservée à l'administrateur, elle permet de :

- ajouter de nouveaux utilisateurs
- modifier un utilisateur (mot de passe, rôle, validité)
- supprimer un utilisateur

<img src="images/admin.PNG" alt="admin" width="350" />

## Add user

Cette page permet d'ajouter un utilisateur à la base de données.

<img src="images/add_user.PNG" alt="add_user" width="350" />

## Modify role of user

Cette page permet de modifier le rôle d'un utilisateur.

<img src="images/modify_role.PNG" alt="modify_role" width="350" />

## Modify validity of user

Cette page permet de modifier la validité d'un utilisateur.

<img src="images/modify_val.png" alt="modify_val" width="350" />

(À savoir qu'un comportement bizarre a parfois été observé sur cette page qui nous redirigeais sans raison sur l'Inbox.)

