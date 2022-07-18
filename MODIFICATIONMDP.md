# Modification de la structure de la table 'users'

Pour utiliser la fonction password_hash() de PHP, il est nécessaire de modifier la structure de la table 'users', particulièrement le champ 'mdp'.
Initialement en CHAR(40), il faut le passer en VARCHAR(255) avec la requête SQL suivante :
```ALTER TABLE utilisateurs CHANGE mdp mdp VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL; ```