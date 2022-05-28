# bddgestion
Gestion de la base de données ||| SAE 203

1 - SAE folder
  Vous retrouverez dans ce dossier le code source que j'ai développé dans le cadre d'une SAE dans mon IUT. 
  C'est un SGBD qui offre beaucoup de fonctionnalités.
  La plupart d'entre elle n'était pas attendue par l'exercice mais pour m'exercer j'ai décidé d'en développer le plus possible.

** POUR LA TESTER : https://www.neotica.ml-digital.fr **

  ETAPES D'UTILISATION :

    a - créer dans PHPmyAdmin une base de données nommée NEOTICA, et importer le dump neotica.sql présent dans le dossier.
    b - mettre le dossier neotica-v1.0 directement dans le dossier WWW de wamp
    c - normalement, le site est désormais utilisable en local
    d - j'ai essayé de commenter le maximum de fichier pour vous en faciliter la compréhension.
    e - si une erreur de connexion à la $BDD (base de données) apparait, allez dans controllers/connect-database.php et modifiez $username et $password pour mettre les bons logs de votre serveur

  --
  
  ETAPES DE CONCEPTION :

    a - Le coeur de connexion se trouve dans ~/include/core/connect-core.php et ~/include/core/connect-admin-core.php
    b - Le système de modal est fait en Javascript
    c - Tout le reste est fait en PHP natif à des fins pédagogique d'apprentissage (sans framework).
    d - Ce site a été développé from scratch, sans l'utilisation de templates.
    e - pour lire le fichier CSS merci de lire le style.SCSS qui est entièrement commenté, contrairement au style.CSS qui est compilé et donc non commenté.
    
  --
--
