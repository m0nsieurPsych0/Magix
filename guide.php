<?php
    require_once("action/GuideAction.php");

    $action = new GuideAction();
    $data = $action->execute();
    $page = "guide";
    
    require_once("partial/header.php");

    ?>
                <main>
                    <!-- ----------------------SECTION TEMPLATE------------------------------- -->
                    
                        <!-- CRÉER ARTICLE -->
                    <template id="template-creer-article">
                        <!-- Pour passer des arguments supplémentaire -->
                        <input type="text" class="type" id="article" name="article">
                        <input type="text" class="type" id="add" name="add">

                        <textarea id="titre-creer"  placeholder="Titre de l'article" name="titre"></textarea>
                        <textarea id="contenu-creer" placeholder="Le contenu de l'article" name="contenu"></textarea>
                        <button id="boutonAction">Créer</button>
                    </template>

                        <!-- EFFACER ARTICLE -->
                    <template id="template-effacer-article">
                            <input type="text" class="type" name="article">
                            <input type="text" class="type" id="del" name="del">
                            <input type="text" class="type" id="articleId-effacer" name="articleId">
                            <button id="effacer-article">Effacer</button> 
                    </template>

                        <!-- MODIFIER ARTICLE -->
                    <template id="template-modifier-article">
                        <!-- Pour passer des arguments supplémentaire -->
                        <input type="text" class="type" name="article">
                        <input type="text" class="type" id="mod" name="mod">
                        <input type="text" class="type" id="articleId" name="articleId">

                        <textarea id="titre-creer"  placeholder="Titre de l'article" name="titre"></textarea>
                        <textarea id="contenu-creer" placeholder="Le contenu de l'article" name="contenu"></textarea>
                        <button id="boutonAction">Modifier</button>
                    </template>

                    <!-- AFFICHER ARTICLE -->
                    <template id="template-article">
                        <h1 id="titre"></h1>
                        <div id="auteur-date-wrapper">
                            <div id="auteur-article"></div>
                            <div id="date-article"></div>
                        </div>
                        <div id="contenu"></div>
                    </template>
                        
                        <!-- AJOUT COMMENTAIRE -->
                    <template id="template-ajout-commentaire">
                        <!-- Pour passer des arguments supplémentaire -->
                        <input type="text" class="type" name="comment">
                        <input type="text" class="type" name="add">
                        <input id="articleId-comment" type="text" class="type" name="articleId">

                        <textarea id="ajout-auteur"  placeholder="Votre nom" name="auteur" required></textarea>
                        <textarea id="ajout-commentaire" placeholder="Votre commentaire" name="contenu" required></textarea>
                        <button id="envoyer">Envoyer</button>
                    </template>
                        
                        <!-- AFFICHER COMMENTAIRE -->
                    <template id="template-commentaire">
                        <div class="auteur-date-wrapper">
                            <div class="auteur-commentaire"></div>
                            <div class="date-commentaire"></div>
                        </div>
                        <div class="contenu-commentaire"></div>
                    </template>

                        <!-- AFFICHER LISTE ARTICLE -->
                    <template id="template-creer-liste">
                        <div class="liste-auteur"></div>
                        <div class="liste-date"></div>
                    </template>

                        <!-- CREER BOUTONS LISTE ARTICLE -->
                    <template id="articleList-form">
                        <form action="guide.php" method="post" autocomplete="off">
                            <input type="text" class="type" name="article">
                            <input type="text" class="type" name="get">
                            <input type="text" class="type articleId" name="articleId">
                            <button><div class="liste-titre"></div></button>
                        </form>
                    </template>


                    <div id="article">
                        <?php
                        if(!$data["db"]["article"]){
                            ?> 
                            <div>Aucun article disponible...&nbsp&nbsp&nbspVeuillez en créer un --></div>
                            <?php
                        } 
                        if(isset($_SESSION['username'])){ 
                            ?> 
                            <button id="creer-article" onclick='createArticle();'>Créer un article</button>                                     
                            <?php if(isset($data["db"]["article"])){ ?>
                                
                                <button id="modifier-article" onclick='modifyArticle( <?php echo(json_encode($data["db"]["article"])); ?> );'> Modifier</button> 
                                <script> deleteArticle( <?php echo(json_encode($data["db"]["article"])); ?> ); </script> 
                            <?php
                            } ?>
                        <?php 
                        } ?>
                        
                    </div>

                    <div id="historique"></div>


                </main>

                <!-- Pour afficher les articles en passant une variable PHP -->
                <script>displayArticle( <?php echo(json_encode($data["db"]["article"])); ?> );</script>
                <script>loadHistory( <?php echo(json_encode($data["db"]["articleList"])); ?> );</script>
                
                

                
<?php
	require_once("partial/footer.php");