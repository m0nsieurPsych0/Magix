<img src="asset/logo/logo.gif">

<h2>Présentation Générale</h2>
<p>
Ce projet a été donnée durant le cours de web avancée au Cégep du Vieux Montréal par le professeur Frédérique Thériault. Le but était de coder la partie jeu en utilisant l'API de MAGIX qui permet la communication entre joueur en ligne. Nous devions utiliser un server PHP pour livrer les pages web et AJAX pour communiquer en temps réel avec l'API. Bien sur tout le reste utilise le trident du web, c'est-à-dire HTML, CSS et JavaScript.
</p> 
<p>
Mon objectif à été de faire comme si c'était un système d'exploitation d'où la partie «OS» au titre. Mon inspiration pour l'apparence, est basée sur de vieux système d'exploitation en ligne de commande. Pour retrouver le sentiment de l'époque, j'ai tenté de reproduire l'effet d'un écran cathodique en appliquant un filtre scanline sur toute la page ainsi qu'un fond d'écran arondi blanc très subtile. De plus, si on est attentif on pourra observer des variations de luminosité -- plus visible sur le texte -- rappelant l'apparence dansante de ces écrans.
</p>
<h2>Navigation</h2>

<h3>booting.php</h3>
<p>
Lorsqu'on navigue au site pour la première fois, le code JavaScript de la page vérifie si |\/|agix__OS est démarré. La vérification est faite en cherhcant dans localStorage la clef "booted" et la valeur "true". Si on la trouve et qu'elle est à vraie, on ne démarre pas et on passe directement à home.php si on est déjà authentifié. 
</p>
<img src="asset/readme/booting/booting.gif"/>

<h3>login.php</h3>
<p>
La page de login malgré son apparence simpliste est particulière puisque c'est de là que j'ai établis le style et l'atmostphère global de |\/|agix__OS. Ainsi on peut observer le fond d'écran clairement et voir l'effet arrondi qui ajoute à la simulation de l'écran cathodique.
</p>
<p>
On peut constater que malgré les champs pour envoyer nos informations de connexion, il n'y a pas de bouton envoyer comme ce serait le cas dans un système strictement en ligne de commande. C'est-à-dire qu'on doit pesez sur la touche « enter » du clavier.
</p>
<p>
On peut aussi accéder à la page du guide stratégique en cliquant sur le liens situé le coin inférieur droit. Si on accède au guide stratégique par ce lien, on est considéré comme un invité et on ne peut pas écrire d'article. Cependant, on peut consulter ceux existant et y écrire des commentaires.
</p>
<img src="asset/readme/login/login.gif"/>

<h3>home.php</h3>
<h4>Barre d'accès</h4>
<p>
La page d'accès pour tout les services que |\/|agix__OS offre. 
<br>
Sur la gauche on trouve une barre avec tous les liens pour accéder aux différentes parties du système.
<br>
<h4>Section chat et messages système</h4>
<p>
À droite, en proéminence, on peut échanger avec les joueurs connectés grâce au chat. Juste en dessous on retrouve la zone de messages du système et là on voit affiché quelques informations à notre propos:
<li>L'heure de notre dernière connexion</li>
<li>Le résultat de la dernière partie</li>
<li>Le nombre de partie gagnée</li>
<li>Le nombre de partie perdue</li>
<li>Le nombre de trophée total </li>
</p>
<img src="asset/readme/home/home.gif"/>

<h4>
Détails sur le fonctionnement de la navigation aux différents mode de jeu
</h4>
<p>
Pour faire la sélection d'un mode de jeu, on envoit une requête «GET» avec une clef. Cette clef est évaluée dans homeAction et dépendemment de celle-ci on est redirigé vers le mode de jeu approprié. 
<h4>
Détails sur la zone message système
</h4>
Pour la section où on extrait les données pour les messages systèmes on a porté une attention particulière à la séparation Model View Controller et au lieu d'afficher directement avec PHP on utilise JavaScript pour le faire.
</p>

<h3>deckmaster.php</h3>
<p>
La page deckMaster contient deux Iframes communiquant avec l'API. Le premier est celui du chat comme pour la page home.php et game.php. Sur cette page on peut le cacher ou l'afficher à notre guise. Au centre, nous avons l'autre Iframe permettant de modifier notre jeu de carte.
</p>
<img src="asset/readme/deckmaster/deckmaster.gif"/>

<h3>guide.php</h3>
<p>
Sur cette page on peut écrire des articles en interragissant avec une base de donnée Mysql. Au centre de la page est chargé par défaut l'article le plus récent créé ou modifié. À droite, on a la liste de tout les articles en ordre antéchronologique.
</p>
<p>
Si l'utilisateur est authentifié au travers de l'API, il a la possibilité d'ajouter, de modifier ou d'effacer les articles. Si l'utilisateur est un invité il peut seulement écrire des commentaires. Les commentaires sont permanent à chaque article. C'est-à-dire qu'on ne pourra les effacer que si on efface un article. Ce choix est par design.
</p>
<img src="asset/readme/guide/guide.gif"/>

<h4>Fonctionnement du code du guide stratégique</h4>
<p>
Tous les boutons sont des formulaire qui envoient des données en «GET» lorsqu'on pèse dessus. Seul les boutons «créer» et «modifer» modifie la page sur le champs sans automatiquement envoyer de formulaire. Donc si on pèse sur un des deux on modifie le contenu pour afficher des formulaires soit de création, soit de modification. Si on est dans le mode «modifier» les champs «textarea» sont préremplient avec le contenu de l'article. Enfin, on peut retourner à l'état précédant en appuyant sur «annuler». <br>
</p>
<p>
Avant d'envoyer l'information entrée (commentaire ou article), nous encodons dans le serveur PHP à l'aide de «htmlentities» les guillemets simple ou double. La raison pour laquelle nous faisons ça c'est pour éviter que le contenu des articles ou des commentaires interfère avec le code html de la page. Dans un des cas avant de faire la modification, la fonction «modifyArticle» ne fonctionnait pas puisque le guillemets fermaient au mauvais endroit empêchant l'exécution du code. De plus, cela «devrait» ajouter un peu plus de protection contre les injections SQL.
</p>
<h3>game.php</h3>
<p>
Cette page est divisée en deux grandes sections: la barre d'outils et la zone de jeu.
</p>
<p>
Sur la partie de gauche, sur la barre d'outils, on trouve tous les détails de votre adversaire: Sa classe, son talent choisit et ses statistiques. Bien sur, juste en dessous, on a aussi accès au chat, car un duel ne serait être complet sans quelques provocations.
</p>
<p>
À droite, dans la partie jeu, on trouve trois sous section: La première en haut est la zone de l'adversaire, au centre, la plateforme du jeu et en dessous la zone du joueur.
</p>
<img src="asset/readme/game/game.gif"/>

<h3>index.php</h3>
<p>
Toutes les pages même à l'écran de veille! On peut intérragir avec la page en bougeant la souris dans différentes partie de la fenêtre pour changer la direction des étoiles. Plus on est dans un coin, plus les étoiles bougent rapidement dans cette direction. Comme pour les écrans de veille traditionnels, quand on pèse sur une touche du clavier ou qu'on clique quelque part sur la page on est ramené où nous étions.
</p>

<p>
<strong>L'écran de veille démarre après 5 minutes d'inactivitées sur toutes les pages excepté game.php.</strong>
</p>
<img src="asset/readme/screensaver/screensaverMouvement.gif"/>
