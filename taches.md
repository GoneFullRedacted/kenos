# Découpage des tâches

## Les droits

Les utilisateurs pourront :

- Ecrire un commentaire
- Le modifier

- Modifier leur profil
- Ajouter/supprimer une photo de profil
- Ajouter/supprimer une bannière de profil

- Ecrire un post
- Le modifier
- Le supprimer (?)

Les utilisateurs devront :

- Se connecter
- S'inscrivent

---

Les admninistrateurs pourront :

- Accéder à la liste des utilisateurs
- Supprimer un utilisateur
- Modifier les informations d'un utilisateur

- Accéder aux catégories
- Ajouter/supprimer une catégorie
- Modifier les catégories

- Ecrire une news
- La modifier
- La supprimer
- Accéder à une liste des news / posts (?)

Les administrateurs devront :

- Se connecter
- S'inscrivent

---

Le compte super-admin pourra :

- Hérite des pouvoirs des autres roles

- Ajouter/supprimer une localisation
- Modifier une localisation

Le super-admin devra :

- Se connecter

## L'organisation qui en découle

Pour les utilisateurs :

- 1 page pour les commentaires
- 1 page pour le profil
- 1 page pour la gestion des posts

Pour les admins :

- 1 page pour la visualisation et la suppression des utilisateurs
- 1 page pour modification des utilisateurs
- 2 page pour la gestion des catégories (une page affichage / une page modification)
- 2 page pour la gestion des news (une page affichage / une page modification)
- 2 page pour la gestion des posts
- 1 dashboard

Pour le super-admin :

- 1 page pour la gestion des localisations

---

En ce qui concerne le site en lui même :

Pour les trois, le devoir de se connecter implique évidemment la création d'une page de login.

Sachant que le super-admin hérite des droits des admins, qui eux même héritent des droits des utilisateurs.

De plus, il serait judicieux (et plus pratique) de permettre à par exemple un utilisateur scrollant les posts d'avoir accès a des options en plus si il passe sur un post créer par lui même (raccourci de suppresion, redirection vers la page de modification).

Egalement, il ne faut pas oublier la gestion des likes.

Et pour finir, le coeur du projet :

- L'acceuil qui affiche son propre profil, les news et les posts.
- Une page trombinoscope qui affiche les utilisateurs
- Une page pour les news
- Une page unique à la news
- Une page pour les posts
- Une page d'affichage de profil
