# Doctofiche Repo

## Historique

- Développé par un premier développeur en pure PHP avec l'architecture et organisation actuelle - 2019-2020.
- Repris par un second développeur (moi) - Juin - September 2020.
- Décision de ne pas réecrire l'application entièrement mais revoir le design et ajouter quelques fonctionnalitées pour lancer la plateforme en Septembre.
- Prise de conscience de la nécessité de revoir la plateforme (bug à répétition, lenteur, désire d'avoir une application mobile) et en profiter pour s'orienter vers une PWA.

## Organisation

Le site doit rester disponible en parallèle du développement et l'intégration du nouveau Front/Back doit se faire de manière modulaire.
Discuter avec le client pour décider de l'ordre dans lesquels les parties du site sont reprises, je commencerai avec la partie Fiche/Conseils/etc. puisque c'est la fonction principalement utilisé par les utilisateurs - et serait beaucoup plus agréable avec React/Vue.

## Devis

### Backend

- Reorganisation du backend avec l'aide d'un framework (Laravel - Symfony ou autre, tant que c'est un des majeurs).
- Optimisation de la base de données (les inscrits non abonnées n'ont pas besoin d'une copie des fiches, simplement une 'référence' )
- Si possible, se rapprocher d'une structure type REST API afin de démêler le back-end du front-end.

### Front end

- Reecrire le front avec une technologie permettant le PWA, de préférences React ou Vue.
- De manière générale, réorganiser le code pour éviter les répétitions - et encourager les modules (notamment au niveau du Javacsript, éviter un énorme module!)
- Virer jQuery.

### Accompagnement client

- Conseiller le client dans les choix techniques.
- Être disponbile et accompagner le client dans la gestion du site.
