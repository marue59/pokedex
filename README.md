# Pokédex

## Présentation :

L'objectif de cet exercice est d'avoir un Pokédex simpliste grâce à l'API éducative
https://pokeapi.co/.

- Il est demandé d'avoir un listing de Pokémon filtrés sur une
  génération donnée et de pouvoir accéder à leur détails sur une page dédiée. Le
  seul choix technique imposé est d'utiliser Symfony, pour le reste vous êtes libre
  de vos choix : que ce soit dans l'utilisation de dépendances (ou non) ou encore
  du framework CSS (ou non) à utiliser.
  Voici la liste des points demandés :
- Initialisation de votre environnement de travail (dépôt Git, Symfony,
  plugins pour votre éditeur de code, ...)
- La récupération des nouveaux Pokémon doit être enregistrée en base de
  données à des fins d’optimisation du temps d’affichage et d’économisation
  de bande passante. L’utilisation d’un SGBD relationnel est attendu
- Le choix de la génération de Pokémon doit pouvoir être configurable via
  une variable d'environnement
- Intégration du listing de Pokémon avec les options de tri suivantes : nom,
  numéro national et type
- Intégration d'une page détails de Pokémon, le lien d'entrée doit se trouver
  sur le listing
- Création d'une Command permettant d'exporter en format CSV les
  Pokémon (les attributs standard suffiront, comme leur ID, nom et avatar
  par exemple)

## Installation :

```
git clone git@github.com:marue59/pokedex.git
```

```
composer install
```

● Configurer votre base de données :

```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
```

● Puis lancer la migration pour créer les tables dans la base de données :

```
php bin/console doctrine:migrations:migrate
```

● Lancer votre serveur :

```
symfony serve
```

## A propos :

Projet conçu par Marie Defretin pour l'équipe d'Efipeek
