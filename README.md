<h1>|\/|agix__OS__________________________________________________________________________________________</h1>
<br>

<h2>Présentation Générale</h2>
<p>
    Comme ce projet est un front-end à l'API de MAGIX, mon objectif à été de faire comme si c'était un système d'exploitation d'où la partie «OS» au titre. <br>
    Mon inspiration pour l'apparence est basée sur de vieux système d'exploitation en ligne de commande avec une touche de moderne. <br>
    Pour reproduire le sentiment de l'époque, j'ai tenté de reproduire l'effet' d'un veil écran cathodique en appliquant un filtre scanline sur toute la page.<br>
    De plus, si on est attentif on pourra observer des variations de luminosité -- plus apparant sur le texte -- rappelant l'apparence dansante de ces écrans.
</p>
<h2>Navigation</h2>
<p>Il y a 6 pages différentes:</p>
<li>index.php</li>
<li>login.php</li>
<li>home.php</li>
<li>game.php</li>
<li>deckMaster.php</li>
<li>guide.php</li>
<br>
<h3>index.php</h3>
<p>
    On est dans le mode écran de veille. On peut intérragir avec la page en bougeant la souris dans différentes partie de la fenêtre pour changer la direction des étoiles.<br>
    Plus on est dans un coin, plus les étoiles bouge vite dans cette direction. <br>
    Comme pour les écrans de veille traditionnels, quand on pèse sur une touche du clavier ou qu'on clique quelque part sur la page on sort du mode.<br>
    Si on est connecté on est dirigé vers home.php, sinon on est dirigé vers login.php. <br>
    L'écran de veille est activé après 5 minutes d'inactivité sur toutes les pages à part celle de game.php. <br>
</p>
<br>
<h3>login.php</h3>
<p>
    La page de login malgré son apparence simpliste est particulière, puisque c'est de là que j'ai établis le style et l'atmostphère global de |\/|agix__OS. <br>
    C'est là qu'on peut observer le fond d'écran clairement et voir l'effet arrondi qui ajoute à la simulation de l'écran cathodique. <br>
</p>
<p>
    Vous pourrez constater que malgré le formulaire pour envoyer nos informations de connexion, il n'y a pas de bouton envoyer comme ce serait le cas dans un système strictement en ligne de commande. <br>
    La dernière modification apportée à cette page a été un liens pour consulter le guide stratégique. Vous le trouverez dans le coin inférieur droit.
</p>
<br>
<h3>home.php</h3>
<h4>Barre d'accès</h4>
<p>
    La page d'accès pour tout les services que |\/|agix__OS offre. <br>
    Dans la barre de gauche vous allez trouver tous les liens pour accéder aux différentes parties du système. <br><br>
    Les trois premier mène à game.php:
    <li>__Jouer -> Partie contre un autre joueur</li>
    <li>__Pratiquer -> Partie contre l'ordinnateur</li>
    <li>__Observer -> Observer une partie du point de vue d'un joueur qu'on choisit</li><br>
    __Deck_Master mène à deckMaster.php: <br>
    <li>Permet de faire des modifications à son jeu de carte</li><br>
    __Guide__Stratégique:<br>
    <li>Permet de créer des articles </li><br>
    __Écran__de__Veille:<br>
    <li>Permet d'activer l'écran de veille</li><br>
    __Quitter: <br>
    <li>Permet de se déconnecter en détruisant la clef de session de l'API et celle du serveur PHP</li>
</p>
<h4>Section Chat et messages système</h4>
<p>
    À droite en proéminence le chat et en dessous les messages du systèmes. <br>
    La zone de messages de système est là pour afficher quelques informations sur le joeur connecté:
    <li>L'heure de sa dernière connexion</li>
    <li>Le résultat de la dernière partie</li>
    <li>Le nombre de partie gagnée</li>
    <li>Le nombre de partie perdue</li>
    <li>Le nombre de trophée </li>
</p>
<h4>Fonctionnement Action</h4>
<p>
    Pour faire la sélection d'un mode de jeu, nous envoyons une requête «GET» avec une clef. Cette clef est évaluer dans homeAction et dépendemment on sera rediriger vers le mode de jeu approprié.<br>
    Pour la section où nous extrayons les données pour les messages systèmes nous avons porté une attention particulière à la séparation MVC et au lieu d'afficher directement avec php nous utilisons JavaScript pour le faire.
</p>
<br>
<h3>deckMaster.php</h3>
<p>
    La page deckMaster contient deux Iframes reliant le API. Le premier est celui du chat comme pour la page home.php, nous pouvons sur cette page le cacher ou l'afficher à notre guise.<br>
    Au centre, nous avons l'autre Iframe permettant de modifier notre sélection de carte. 
</p>
<h3>guide.php</h3>
<p>
    Sur cette page nous pouvons écrire des articles en interragissant avec une base de donnée Mysql. <br>
    Au centre de la page est chargé par défaut l'article le plus récent créé ou modifié. <br>
    À droite, nous avons la liste de tout les articles en ordre antéchronologique.
</p>
<p>
    Si l'utilisateur est authentifié au travers de l'API, il a la possibilité d'ajouter, de modifier ou d'effacer les articles.<br>
    Si l'utilisateur est un inviter il peut seulement écrire des commentaires. Les commentaires sont permanent à chaque article. <br>
    C'est-à-dire qu'on ne pourra les effacer que si on efface un article. Ce choix est par design.
</p>
<h4>Le fonctionnement</h4>
<p>
    Tous les boutons sont des formulaire qui envoient des données en «GET» lorsqu'on pèse dessus. <br>
    Seul les boutons «créer» et «modifer» modifie la page sur le champs sans automatiquement envoyer de formulaire.<br>
    Donc si on pèse sur un des deux on modifie le contenu pour afficher des formulaires soit de création, soit de modification.<br>
    Si on est dans le mode «modifier» les champs «textarea» sont préremplient avec le contenu de l'article. <br> 
    Enfin, on peut retourner à l'état précédant en appuyant sur «annuler». <br>
</p>
<p>
    Une autre spécification, avant d'envoyer l'information entrée (commentaire ou article), nous encodons dans le serveur PHP à l'aide de «htmlentities» les guillemets simple ou double.
    La raison pour laquelle nous faisons ça c'est pour éviter que le contenu des articles ou des commentaires interfère avec le code html de la page. Dans un des cas avant de faire la modification, la fonction «modifyArticle» ne fonctionnait plus puisque le guillemets fermait au mauvais endroit empêchant l'exécution. De plus, cela «devrait» ajouter un peu plus de protection contre le «SQL injection».
</p>
<h3>game.php</h3>
<p>
    Sur la barre de gauche nous avons les détails de la classe et du talent choisit. En dessous, nous avons des statistiques du joeur. Sur cette même barre nous avons aussi le chat.
    À droite, nous avons le gameboard au dessus les status de l'ennemie. Au centre, le jeu et en dessous le status du joeur.

</p>
<br>
<br>
<br>




Navigation générale -> la barre de titre dans les pages __Deck_Master et __Guide_Stratégique dirige à home.php.

