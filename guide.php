<?php
    require_once("action/GuideAction.php");

    $action = new GuideAction();
    $data = $action->execute();
    $page = "guide";
    
    require_once("partial/header.php");

    // var_dump($data['db']['articleList']);
    ?>
                <main>
                    <div id="article">
                        <?php if(isset($_SESSION['username'])){ 
                            ?> 
                            <button id="creer-article" onclick="createArticle();">Créer un article</button> 
                            
                            
                            <?php if(isset($data["db"]["article"])){ ?>
                                
                                <!-- <button id="creer-article" onclick="createArticle();">Créer un article</button> 
                                
                                <form action="guide.php" method="post" autocomplete="off">
                                    <input type="text" class="type" name="article">
                                    <input type="text" class="type" name="get">
                                    <input type="text" class="type" name="articleId">
                                    <button id="effacer-article">Effacer</button> 
                                </form> -->
                            <?php
                            } ?>
                        <?php 
                        } ?>
                    </div>

                    <div id="historique"></div>
                    <!-- Pour chaque année en ordre décroissante -->
                    <!-- Pour chaque article en ordre antéchronologique-->
                    

                    <template id="template-creer-liste">
                        <div class="liste-auteur"></div>
                        <div class="liste-date"></div>
                    </template>
                    
                    <template id="articleList-form">
                        <form action="guide.php" method="post" autocomplete="off">
                            <input type="text" class="type" name="article">
                            <input type="text" class="type" name="get">
                            <input type="text" class="type articleId" name="articleId">
                            <button><div class="liste-titre"></div></button>
                        </form>
                    </template>

                    <template id="template-creer-article">
                        <form id="creer-article-wrapper" action="guide.php" method="post" autocomplete="off">
                            <!-- Pour passer des arguments supplémentaire -->
                            <input type="text" class="type" name="article">
                            <input type="text" class="type" name="add">
                            <!-- ---------------------------------------- -->
                            <textarea id="titre-creer"  placeholder="Titre de l'article" name="titre"></textarea>
                            <textarea id="contenu-creer" placeholder="Le contenu de l'article" name="contenu"></textarea>
                            <button id="creer">Créer</button>
                        </form>
                    </template>

                    <template id="template-article">
                        <h1 id="titre"></h1>
                        <div id="auteur-date-wrapper">
                            <div id="auteur-article"></div>
                            <div id="date-article"></div>
                        </div>
                        <div id="contenu"></div>
                    </template>
                        
                    <template id="template-ajout-commentaire">
                        <!-- Pour passer des arguments supplémentaire -->
                        <input type="text" class="type" name="comment">
                        <input type="text" class="type" name="add">
                        <input id="articleId" type="text" class="type" name="articleId">
                        <!-- -------------------------------------------------------- -->
                        <textarea id="ajout-auteur"  placeholder="Votre nom" name="auteur"></textarea>
                        <textarea id="ajout-commentaire" placeholder="Votre commentaire" name="contenu"></textarea>
                        <button id="envoyer">Envoyer</button>
                    </template>
                        
                    <template id="template-commentaire">
                        <div class="auteur-date-wrapper">
                            <div class="auteur-commentaire"></div>
                            <div class="date-commentaire"></div>
                        </div>
                        <div class="contenu-commentaire"></div>
                    </template>
                </main>
                <!-- Pour afficher les articles -->
                <script>displayArticle( <?php echo(json_encode($data["db"]["article"])); ?> );</script>
                <script>loadHistory( <?php echo(json_encode($data["db"]["articleList"])); ?> );</script>

                <!-- ----------------------SECTION TEMPLATE------------------------------- -->

                
<?php
	require_once("partial/footer.php");