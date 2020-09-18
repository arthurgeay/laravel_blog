# ✨ Laravel Blog  
  
**Laravel Blog** est une application web développé avec **Laravel** et **VueJS**. 

La plateforme de blog permet à n'importe quel utilisateur inscrit de pouvoir publier des articles.
Une fois un article publié, il pourra alors le modifier ou le supprimer. Il sera également maitre de la modération des commentaires signalés par les autres utilisateurs (inscrits ou non inscrits).

Le but de ce projet était de monter en compétence à la fois sur Laravel et sur VueJS.
  
## Fonctionnement  

Le projet propose différentes pages et fonctionnalités : 
- **Page d'accueil** : Liste les différents articles postés sur la plateforme (paginés)
- **Page d'un article** : Affiche le contenu de l'article ainsi que les commentaires associés (paginés)
- **Inscription / Authentification**
- **Administration** : Gestion de SES articles (CRUD) et des commentaires signalés sur les articles de l'utilisateur (Ignorer ou supprimer le commentaire).

## Technologies utilisées  
- **[Laravel](https://laravel.com/)** - Framework PHP
- **[VueJS](https://fr.vuejs.org/)** - Framework Javascript
- **[MySQL](https://www.mysql.com/fr/)** - Base de données relationnelle
- **[Axios](https://github.com/axios/axios)** - Client HTTP 
  
  
## Installation  
**Installation du projet**
```sh  
# Installation des dépendances PHP
composer install

# Installation des dépendances Javascript
npm install  
```  
**Mise en place des données**
```sh  
# Lancement des migrations
php artisan migrate 

# Peuplement de la base de données
php artisan db:seed
```  
## Exemple de compte utilisateur de test

```sh  
# Identifiant
test0@example.com
 
# Mot de passe
test
```  
  
## Auteur  
  
👤 **Arthur Geay**  
  
* Site: https://arthurgeay.fr  
* Twitter: [@arthurgeay](https://twitter.com/arthurgeay)  
* GitHub: [@arthurgeay](https://github.com/arthurgeay)
