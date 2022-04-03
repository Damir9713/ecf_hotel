# ecf_hotel

# Déploiement en local

Pour déployer l'application en local il vous faudra plusieurs services comme:
- google captcha
- xampp 

Commencer par installé xampp sur  votre machine.

![Capture d’écran (172)](https://user-images.githubusercontent.com/89656393/161431361-725253a0-d7c8-418c-a80f-008bdd182811.png)

Une fois xampp installé cliqué sur start sur apache et start sur MySql pour mettre le serveur en route puis cliqué sur admin sur MySql pour ouvrir le localhost.
Ouvrez le terminal "shell" puis tapez la commande "mysql -u root -p" pour vous connecter à votre serveur.

![Capture d’écran (173)](https://user-images.githubusercontent.com/89656393/161431473-a0afa6e9-f245-4b5f-a9f3-ac844b5a6a6e.png)

Entrez les lignes de commandes qui sont dans le fichier hotel.sql dans le dossier "dossier technique" pour créer la base de données et ses tables.
Vous pouvez vérifier que tout est bien installé sur phpmyadmin pour avoir une vue d'ensemble de la base de données et ses tables.

![Capture d’écran (174)](https://user-images.githubusercontent.com/89656393/161431594-1f9712b6-a043-44c6-ba69-57f1f352254d.png)

Pour vous connecter à votre serveur en locale depuis l'application aller dans le fichier "action/database.php"
puis rentrez vos identifiants qui de base sont "root"  et le mot de passe il y en a pas quand vous installez xampp
puis renseignez la base de données sur laquelle vous souhaitez vous connecter.

![Capture d’écran (185)](https://user-images.githubusercontent.com/89656393/161434427-959903df-9f76-474f-bb71-96041062ff81.png)

En local pour la gestion des images , il faudra que vous envoyer vos images dans le dossier upload à l'aide de "move_uploaded_file($_FILES['images']['tmp_name'], $upload); "

Vous pouvez mettre en commentaires la section de code juste en dessous du "if(in_array($type_file, $type))" et avant l'insert dans la base de données
Cette section de code concernent pour la gestion d'images pour un déploiement en ligne.

![Capture d’écran (175)](https://user-images.githubusercontent.com/89656393/161431713-56fd6215-3280-46b0-a5a9-3f897dafba9f.png)

Pour affiché l'images dans la section que vous souhaitez, il faudra procéder comme ceci , pour que l'application aille chercher le chemin de l'image
dans la base de données et l'affiché à l'écran.

![Capture d’écran (176)](https://user-images.githubusercontent.com/89656393/161432138-02356103-7e4f-47fe-a1c8-8cdceb727a58.png)


Pour le sercice google captcha , vous devrez vous inscrire sur google captcha pour récupérer les clés , dans les nom de domaine il faudra indiquer localhost
Choissisez quel type de captcha vous souhaitez , puis suivez la démarche indiqué par google , les codes vous seront fournit par google qui vous indiquera
où mettre les clés. Installez le dans le fichier "login.php" et "action/loginAction.php".

![Capture d’écran (177)](https://user-images.githubusercontent.com/89656393/161433314-aeaec5d5-7efa-4ac3-8884-d57d2670f5bd.png)


Pour pouvoir voir votre application en live, il vous faudra installé le fichier de l'application dans le fichier "htdocs" dans les fichiers de xampp.
Puis tapez "localhost/nomApplication" dans la barre d'url.

#
# Déploiement en ligne

Pour le déploiement en ligne vous aurez besoin de: 
- amazon s3
- google captcha
- heroku
- github
- xampp
 
Commencer par créer un compte heroku sur le site d'heroku , puis créer une nouvelle application , une fois que vous avez créer votre application
vous devez créer une pipeline. 

![Capture d’écran (178)](https://user-images.githubusercontent.com/89656393/161433400-6b765558-60fa-4211-ae80-0b2750c42769.png)

Créer une nouvelle pipeline.

![Capture d’écran (180)](https://user-images.githubusercontent.com/89656393/161433630-fc9f7101-8cb0-4057-975d-af62bbb4a655.png)


connectez votre compte github à votre application en reliant votre repository à votre application.


![Capture d’écran (181)](https://user-images.githubusercontent.com/89656393/161433746-7776e73a-c44b-4a5e-b530-aa75493502e7.png)

Une fois que votre application est connecté à votre repository github , vous pouvez choisir de mettre votre application en déploiement automatique
à chaque fois que vous allez pull sur votre repository , votre application se mettra automatiquement à jour.

![Capture d’écran (182)](https://user-images.githubusercontent.com/89656393/161433951-860a1f1d-4f9f-4850-8c58-d324ed3dcf1d.png)

Aller dans "ressources" puis ajouter un add-on pour votre base de données , dans mon cas j'ai choisit "clearDB" , il faudra renseigner votre carte bancaire
pour cet étape mais rassurez-vous , vous pouvez choisir le plan gratuit et aucune somme ne vous sera déduite.

![Capture d’écran (183)](https://user-images.githubusercontent.com/89656393/161434120-842f8b73-7030-44f6-8a8c-57472e947287.png)


Aller dans les paramètres dans la section " config vars " récupérer les accès à la base de données.


![Capture d’écran (186)_LI](https://user-images.githubusercontent.com/89656393/161434842-4d587edf-68ba-4bfc-8b77-3072e39bf8f6.jpg)

Ensuite dans les fichiers de xampp chercher le fichier "config.inc" ou alors dans le panel de controle de xampp à coté de apache cliquer sur config
puis cliqué sur "config.inc" 

![Capture d’écran (188)](https://user-images.githubusercontent.com/89656393/161435023-51b8a047-5aca-4918-a7da-0ffc255455da.png)

Toute à la fin du dossier rajouter ces lignes , avec vos accès à la base de données fournit par heroku.

![Capture d’écran (187)](https://user-images.githubusercontent.com/89656393/161435080-473f9818-8b4d-4efd-b38f-4fb4fe5ae9e2.png)

Connectez vous à phpmyadmin , vous devriez voir votre nouveau serveur apparaitre.

![Capture d’écran (189)](https://user-images.githubusercontent.com/89656393/161435262-309a2de1-5cbe-43bf-83b9-c91b93cbaf10.png)

N'oubliez pas de changer les identifiants dans le fichier "action/database.php" comme montré dans la section déploiement en local
pour que votre application se connecte sur le serveur fournit par heroku.
Il vous reste juste à importer votre base de données créer en local sur votre nouveau serveur.

L'application en ligne , il faut désormais stocké les images sur le service amazon s3 car heroku a chaque nouveau déploiement supprime les images
présente sur l'application.

Après avoir créer votre compte amazon s3 , vous devez créer un nouvel utilisateur et un nouveau compartiement pour stocké les images.

![Capture d’écran (190)](https://user-images.githubusercontent.com/89656393/161435737-72eb99c3-6a08-4e01-b8ab-367a0582178a.png)

![Capture d’écran (191)](https://user-images.githubusercontent.com/89656393/161435744-fd0335c8-5b7b-49d9-8f7e-a1f2b1bc7600.png)

Ensuite il faut ajouté les clé fournit en créant le nouvel utilisateur dans les config var d'heroku.

![Capture d’écran (192)](https://user-images.githubusercontent.com/89656393/161435917-e7fd4cf9-af88-4082-9e2e-43736e5fc496.png)

Heroku fournit le code pour envoyer les images dans le compartiments d'amazon, il faut ensuite l'adapté pour ses besoins.

![Capture d’écran (193)](https://user-images.githubusercontent.com/89656393/161436040-447f40f6-a11b-46ae-995d-d469ab424226.png)

Dans les sections ou vous avez besoin d'envoyer des images , mettez en commentaire le "move_uploaded_file($_FILES['images']['tmp_name'], $upload); "
et remplacez le par le code fournit par heroku pour envoyer les images comme ceci.

![Capture d’écran (175)](https://user-images.githubusercontent.com/89656393/161436331-eeafc554-35ad-4123-bf83-4bddf09e1d60.png)

Puis pour affiché l'image il faut récupérer le lien du compartiement + le chemin stocké dans la base de données comme ceci.

![Capture d’écran (194)](https://user-images.githubusercontent.com/89656393/161436445-1b11292b-c775-4b7a-bcaf-ac21095730de.png)


Pour le captcha de l'application en ligne , n'oubliez pas de rajouter le nom de domaine de l'application en ligne dans les paramètres de google captcha.

![Capture d’écran (196)](https://user-images.githubusercontent.com/89656393/161436716-6e4597ab-8ee6-4e9c-88a0-646c78e8dbbd.png)

L'application est en ligne , les images sont stocké , l'application est prête.
