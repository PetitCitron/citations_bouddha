# citations_bouddha_fr

Un exemple d'outil PHP clef en main pour générer des citations de Bouddha en français.

Il s'agit d'un "passe plat".
Il récupère les citations de Bouddha sur le site [buddha-api.com](https://buddha-api.com) puis
les traduits en français via Google Translate et les affichent.

## Motivation

Proposer des outils "Upload & Play" sans dépendace et PHP From Scratch. <br>
Pour permettre à chacun d'avoir des outils legers et simples.<br>
Ce mouvement est inspiré par le mouvement "IndieWeb", "Small Web" et le "Brutalisme DEV" ou "BRUTAL DEV".
Décomplexer et décomplexifier le développement web,  et le rendre accessible et déployable à tous.


## Installation

A l'ancienne 

## Sur un hebergement
Télécharger le fichier 'citations.php' et le placer dans un répertoire de votre serveur web.<br>
Accéder à ce fichier via votre navigateur via http://<mon_site>/citations.php.

## En ligne de commande

Ou vous pouvez aussi l'utiliser en ligne de commande
    
```bash
curl -s  https://raw.githubusercontent.com/PetitCitron/citations_bouddha/main/citations.php | php
ou
php citations.php
```