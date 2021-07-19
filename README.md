## Contexte :
L’application Telethon a pour but de coordonner et dynamiser les actions du Telethon du département.
Trois objectifs ont été fixés : 
- [x] proposer les activités proposées dans le département
- [x] permettre aux utilisateurs d’avoir accès en temps réel aux activités
- [ ] réaliser un système de QCM, qui permettrait d’ajouter des questions/réponses et permettre aux utilisateurs connectés d’y répondre et d’être classés.

Cette application dialogue avec un serveur web (fichiers présents sur ce repository), pour le stockage sur la base de données externe.

## connexion.php
Ce fichier est appelé depuis l'application lors d'une tentative de connexion d'un utilisateur.
Si le compte existe, les informations le concernants sont renvoyées.

## createVisiteur.php
Ce fichier est appelé depuis l'application lorsqu'un utilisateur tente de s'inscrire.
Si le compte n'existe pas déjà, les informations sont stockées en base de données et l'utilisateur est automatiquement connecté.
