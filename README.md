# elie-church-website
Un site web pour le site web de l'église d'un ami

Ce site web a été conçu avec PHP et MySql

## Mise en oeuvre
Tout d'abord, créez une nouvelle base de données MySQL. Ensuite mettez à jour les variables contenues dans le fichier `database/credentials.php`. Ensuite, copiez et collez le contenu du fichier schema.sql dans la section SQL de PHPMyAdmin ou faites la passer par la ligne de commande. Il devrait créer les tables nécessaires au fonctionnement du panel.

## Composition du projet
Ce projet est composée d'une interface utilisateur par défaut, sur laquelle les utilisateurs pourront accéder aux informations qu'ils désirent.

Il y'a également une interface admin sur laquelle l'administrateur pourra modifier à la volée, les informations qu'il souhaite afficher à l'utilisateur.